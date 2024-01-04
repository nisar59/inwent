<?php

namespace CMS\FooterMenu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\FooterMenu\Entities\FooterMenu;
use CMS\FooterMenu\Entities\FooterMenuHeadings;
use CMS\Pages\Entities\Pages;
use Throwable;
use DataTables;
use Auth;
use DB;
class FooterMenuController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function headingIndex()
    {
        if (request()->ajax()) {
        $footer_menu=FooterMenuHeadings::orderBy('id','ASC')->get();
           return DataTables::of($footer_menu)
           ->addColumn('action',function ($row){
               $action='';
            
               if(Auth::user()->can('footer-menu-headings.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('footer-menu-headings/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('footer-menu-headings.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('footer-menu-headings/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
              if(Auth::user()->can('footer-menu-headings.edit')){
               $action.='<a class="btn btn-secondary btn-sm m-1" href="'.url('footer-menu/'.$row->id).'"><i class="fa fa-bars"></i></a>';
           }
           
               return $action;
           })
            ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('footer-menu-headings/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('footer-menu-headings/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('footermenu::heading-index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function headingCreate()
    {
        return view('footermenu::heading-create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function headingStore(Request $req)
    {
        $req->validate([
            'heading'=>'required',
        ]);
         DB::beginTransaction();
        try{
            FooterMenuHeadings::create($req->except('_token'));
            DB::commit();
            return redirect('footer-menu-headings')->with('success','Footer Menu Heading successfully created');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }
    }


     /**
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function headingStatus($id)
    {
        DB::beginTransaction();
        try{
        $footer_menu=FooterMenuHeadings::find($id);

        if($footer_menu->status==0){
            $footer_menu->status=1;
        }
        else{
            $footer_menu->status=0;
        }
        $footer_menu->save();
        DB::commit();
         return redirect('footer-menu-headings')->with('success','Footer Menu Heading status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function headingEdit($id)
    {
        $footer_menu=FooterMenuHeadings::find($id);
        return view('footermenu::heading-edit',compact('footer_menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function headingUpdate(Request $req, $id)
    {
        $req->validate([
            'heading'=>'required',
        ]);
         DB::beginTransaction();
        try{
            FooterMenuHeadings::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('footer-menu-headings')->with('success','Footer Menu Heading successfully Updated');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function headingDestroy($id)
    {
        DB::beginTransaction();
        try{
        FooterMenuHeadings::find($id)->delete();
        DB::commit();
         return redirect('footer-menu-headings')->with('success','Footer Menu Heading successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }




















/*////////////////////////////////////  Menu ////////////////////////////////////////////////////////////////////*/





















    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        if (request()->ajax()) {
        $footer_menu=FooterMenu::where('cms_footer_menu_heading_id', $id)->orderBy('id','ASC')->get();
           return DataTables::of($footer_menu)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('footer-menu.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('footer-menu/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('footer-menu.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('footer-menu/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('url_type',function ($row){
               $url_type='';
               if($row->url_type==1){
               $url_type.='<span>URL</span>';
                }else{
               $url_type.='<span>Page</span>';                
           }
               return $url_type;
           })
           ->addColumn('target',function ($row){
               $target='';
               if($row->target==1){
               $target.='<span>New Tab</span>';
                }else{
               $target.='<span>Parent</span>';                
           }
               return $target;
           })
           ->addColumn('cms_footer_menu_heading_id',function ($row)
           {
               return $row->menuheading->heading;
           })
           ->rawColumns(['action','url_type','target'])
           ->make(true);
        }
        return view('footermenu::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $footer_menu_heading=FooterMenuHeadings::all();
        $pages=Pages::all();
        return view('footermenu::create',compact('footer_menu_heading','pages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'text'=>'required',
            'url_type'=>'required',
            'url'=>'required',
            'target'=>'required',
        ]);
        DB::beginTransaction();
        try{
            FooterMenu::create($req->except('_token'));
            DB::commit();
            return redirect('footer-menu/'.$req->cms_footer_menu_heading_id)->with('success','Footer Menu successfully created');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $footer_menu_heading=FooterMenuHeadings::all();
        $footer_menu=FooterMenu::find($id);
        $pages=Pages::all();
        return view('footermenu::edit',compact('footer_menu_heading','pages','footer_menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
         $req->validate([
            'cms_footer_menu_heading_id'=>'required',
            'text'=>'required',
            'url_type'=>'required',
            'url'=>'required',
            'target'=>'required',
        ]);
        DB::beginTransaction();
        try{

            FooterMenu::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('footer-menu/'.$req->cms_footer_menu_heading_id)->with('success','Footer Menu successfully updated');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $footer_menu=FooterMenu::find($id); 
            $id=$footer_menu->cms_footer_menu_heading_id
            $footer_menu->delete();
            DB::commit();
         return redirect('footer-menu/'.$id)->with('success','Footer Menu successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
