<?php

namespace CMS\FooterMenu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\FooterMenu\Entities\FooterMenu;
use CMS\Pages\Entities\Pages;
use CMS\FooterMenuHeadings\Entities\FooterMenuHeadings;
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
    public function index()
    {
        if (request()->ajax()) {
        $footer_menu=FooterMenu::select('*')->orderBy('id','ASC')->get();
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
            return redirect('footer-menu')->with('success','Footer Menu successfully created');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('footermenu::show');
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
            return redirect('footer-menu')->with('success','Footer Menu successfully updated');
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
        FooterMenu::find($id)->delete();
        DB::commit();
         return redirect('footer-menu')->with('success','Footer Menu successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
