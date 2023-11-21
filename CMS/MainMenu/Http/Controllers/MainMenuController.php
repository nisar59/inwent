<?php

namespace CMS\MainMenu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\MainMenu\Entities\MainMenu;
use CMS\Pages\Entities\Pages;
use Throwable;
use DataTables;
use Auth;
use DB;
class MainMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $main_menu=MainMenu::orderBy('id','ASC')->get();
           return DataTables::of($main_menu)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('main-menu.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('main-menu/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('main-menu.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('main-menu/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
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
             ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('main-menu/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('main-menu/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','url_type','target','status'])
           ->make(true);
        }
        return view('mainmenu::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pages=Pages::all();
        return view('mainmenu::create',compact('pages'));
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
            MainMenu::create($req->except('_token'));
            DB::commit();
            return redirect('main-menu')->with('success','Main Menu successfully created');
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
        return view('mainmenu::show');
    }
    /**
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $footer_menu=MainMenu::find($id);

        if($footer_menu->status==0){
            $footer_menu->status=1;
        }
        else{
            $footer_menu->status=0;
        }
        $footer_menu->save();
        DB::commit();
         return redirect('main-menu')->with('success','Main Menu status successfully updated');
         
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
    public function edit($id)
    {
        $main_menu=MainMenu::find($id);
        $pages=Pages::all();
        return view('mainmenu::edit',compact('main_menu','pages'));
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
            'text'=>'required',
            'url_type'=>'required',
            'url'=>'required',
            'target'=>'required',
        ]);
        DB::beginTransaction();
        try{
            MainMenu::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('main-menu')->with('success','Main Menu successfully updated');
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
        MainMenu::find($id)->delete();
        DB::commit();
         return redirect('main-menu')->with('success','Main Menu successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
