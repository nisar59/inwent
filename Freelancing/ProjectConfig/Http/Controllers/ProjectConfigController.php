<?php

namespace Freelancing\ProjectConfig\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Freelancing\ProjectConfig\Entities\ProjectConfig;
use Throwable;
use DataTables;
use Auth;
use DB;
class ProjectConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $project_config=ProjectConfig::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($project_config)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('project-config.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('project-config/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('project-config.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('project-config/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('projectconfig::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('projectconfig::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'type'=>'required',
            'name'=>'required',
        ]);
        DB::beginTransaction();
        try{
            ProjectConfig::create($req->except('_token'));
            DB::commit();
            return redirect('project-config')->with('success','Project Configuration successfully created');
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
        return view('projectconfig::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $project_config=ProjectConfig::find($id);
        return view('projectconfig::edit',compact('project_config'));
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
            'type'=>'required',
            'name'=>'required',
        ]);
        DB::beginTransaction();
        try{
            ProjectConfig::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('project-config')->with('success','Project Configuration successfully Updated');
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
        ProjectConfig::find($id)->delete();
        DB::commit();
         return redirect('project-config')->with('success','Project Configuration successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
