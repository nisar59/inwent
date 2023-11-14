<?php

namespace CMS\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\Pages\Entities\Pages;
use Throwable;
use DataTables;
use Auth;
use DB;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $pages=Pages::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($pages)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('pages.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('pages/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('pages.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('pages/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('pages::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pages::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'title'=>'required',
            'slug'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            Pages::create($req->except('_token'));
            DB::commit();
            return redirect('pages')->with('success','Page successfully created');
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
        return view('pages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pages=Pages::find($id);
        return view('pages::edit',compact('pages'));
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
            'title'=>'required',
            'slug'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            Pages::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('pages')->with('success','Page successfully Updated');
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
        Pages::find($id)->delete();
        DB::commit();
         return redirect('pages')->with('success','Page successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
