<?php

namespace Common\ProfessionalTools\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\ProfessionalTools\Entities\ProfessionalTools;
use Throwable;
use DataTables;
use Auth;
use DB;
class ProfessionalToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $professionaltools=ProfessionalTools::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($professionaltools)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('professionaltools.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('professionaltools/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('professionaltools.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('professionaltools/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('type',function ($row){
               $type='';
               if($row->type==1){
               $type.='<span>Other</span>';
                }else{
               $type.='<span>Major</span>';                
           }
               return $type;
           })
           ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('professionaltools/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('professionaltools/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })
           ->rawColumns(['action','status','type'])
           ->make(true);
        }
        return view('professionaltools::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('professionaltools::create');
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
        'title'=>'required',
       ]);
        DB::beginTransaction();
        try{
            ProfessionalTools::create($req->except('_token'));
            DB::commit();
            return redirect('professionalskills')->with('success','Professional Tools successfully created');
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
        return view('professionaltools::show');
    }


    public function status($id)
    {
        DB::beginTransaction();
        try{
        $professionaltools=ProfessionalTools::find($id);

        if($professionaltools->status==1){
            $professionaltools->status=0;
        }
        else{
            $professionaltools->status=1;
        }
        $professionaltools->save();
        DB::commit();
         return redirect('professionaltools')->with('success','Professional Tools status successfully updated');
         
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
        $professionaltools=ProfessionalTools::find($id);   
        return view('professionaltools::edit',compact('professionaltools'));
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
        'title'=>'required',
       ]);
        DB::beginTransaction();
        try{
            ProfessionalTools::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('professionaltools')->with('success','Professional Tools successfully Updated');
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
        ProfessionalTools::find($id)->delete();
        DB::commit();
         return redirect('professionaltools')->with('success','Professional Tools successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
