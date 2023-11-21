<?php

namespace Common\ProfessionalSkills\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\ProfessionalSkills\Entities\ProfessionalSkills;
use Throwable;
use DataTables;
use Auth;
use DB;
class ProfessionalSkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $professionalskills=ProfessionalSkills::orderBy('id','ASC')->get();
           return DataTables::of($professionalskills)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('professionalskills.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('professional-skills/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('professionalskills.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('professional-skills/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
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
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('professional-skills/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('professional-skills/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })
           ->rawColumns(['action','status','type'])
           ->make(true);
        }
        return view('professionalskills::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('professionalskills::create');
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
            ProfessionalSkills::create($req->except('_token'));
            DB::commit();
            return redirect('professional-skills')->with('success','Professional Skill successfully created');
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
        return view('professionalskills::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $professionalskills=ProfessionalSkills::find($id);   
        return view('professionalskills::edit',compact('professionalskills'));
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
        $professionalskills=ProfessionalSkills::find($id);

        if($professionalskills->status==0){
            $professionalskills->status=1;
        }
        else{
            $professionalskills->status=0;
        }
        $professionalskills->save();
        DB::commit();
         return redirect('professional-skills')->with('success','Professional Skill status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
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
            ProfessionalSkills::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('professional-skills')->with('success','Professional Skill successfully Updated');
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
        ProfessionalSkills::find($id)->delete();
        DB::commit();
         return redirect('professional-skills')->with('success','Professional Skill successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
