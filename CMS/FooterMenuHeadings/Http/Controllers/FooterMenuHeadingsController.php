<?php

namespace CMS\FooterMenuHeadings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\FooterMenuHeadings\Entities\FooterMenuHeadings;
use Throwable;
use DataTables;
use Auth;
use DB;
class FooterMenuHeadingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $footer_menu=FooterMenuHeadings::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($footer_menu)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('footer-menu-headings.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('footer-menu-headings/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('footer-menu-headings.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('footer-menu-headings/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
           if(Auth::user()){
               $action.='<a class="btn btn-secondary btn-sm m-1" href="'.url('footer-menu/create/'.$row->id).'"><i class="fa fa-bars"></i></a>';
           }
               return $action;
           })
            ->addColumn('status',function ($row){
               $action='';
               if($row->status==0){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('footer-menu-headings/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('footer-menu-headings/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('footermenuheadings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('footermenuheadings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'heading'=>'required',
        ]);
         DB::beginTransaction();
        try{
            FooterMenuHeadings::create($req->except('_token'));
            DB::commit();
            return redirect('footer-menu-headings')->with('success','Footer Menu Headings successfully created');
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
        return view('footermenuheadings::show');
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
        $footer_menu=FooterMenuHeadings::find($id);

        if($footer_menu->status==1){
            $footer_menu->status=0;
        }
        else{
            $footer_menu->status=1;
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
    public function edit($id)
    {
        $footer_menu=FooterMenuHeadings::find($id);
        return view('footermenuheadings::edit',compact('footer_menu'));
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
            'heading'=>'required',
        ]);
         DB::beginTransaction();
        try{
            FooterMenuHeadings::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('footer-menu-headings')->with('success','Footer Menu Headings successfully Updated');
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
        FooterMenuHeadings::find($id)->delete();
        DB::commit();
         return redirect('footer-menu-headings')->with('success','Footer Menu Headings successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
