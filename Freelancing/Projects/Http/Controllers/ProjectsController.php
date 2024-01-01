<?php

namespace Freelancing\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Freelancing\Projects\Entities\Projects;
use Throwable;
use DataTables;
use Auth;
use DB;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $projects=Projects::orderBy('id','DESC')->get();

           return DataTables::of($projects)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('projects.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('/network/projects/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('projects.delete')){
               $action='<a class="btn btn-danger btn-sm m-1" href="'.url('/network/projects/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('status',function ($row){
               $status='';
               if($row->status==0){
               $status.='<a class="btn btn-primary btn-sm m-1" href="javascript:void(0)">Active</a>';
                }elseif($row->status==1){
                   $status.='<a class="btn btn-info text-white btn-sm m-1" href="javascript:void(0)">Hired</a>';          
                }
                else{
                   $status.='<a class="btn btn-success btn-sm m-1" href="javascript:void(0)">Completed</a>';          
                }

               return $status;
           })

           ->addColumn('user_name',function ($row){
                if($row->user()->exists() && $row->user!=null){
                    return $row->user->name;
                }else{
                    return '<span class="text-danger">User Not Found</span>';
                }
           })
           ->addColumn('user_email',function ($row){
                if($row->user()->exists() && $row->user!=null){
                    return $row->user->email;
                }else{
                    return '<span class="text-danger">User Not Found</span>';
                }
           })
           ->editColumn('created_at',function ($row){
                return $row->created_at->format('d-m-y h:m a');
           })

           ->rawColumns(['action','status','user_name', 'user_email'])
           ->make(true);
        }
        return view('projects::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('projects::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('projects::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('projects::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
        Projects::find($id)->delete();
        DB::commit();
         return redirect()->back()->with('success','Project successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
