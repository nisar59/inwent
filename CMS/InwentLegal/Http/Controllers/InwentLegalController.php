<?php

namespace CMS\InwentLegal\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\InwentLegal\Entities\InwentLegal;
use Throwable;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;
class InwentLegalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $inwant_legal=InwentLegal::orderBy('id','ASC')->get();
           return DataTables::of($inwant_legal)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('inwent-legal.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('inwent-legal/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('inwent-legal.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('inwent-legal/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->editColumn('effective_date',function($row)
             {
                 return Carbon::parse($row->effective_date)->format('d-m-Y');
             })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('inwentlegal::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inwentlegal::create');
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
            'effective_date'=>'required',
            'summary_of_changes'=>'required',
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            InwentLegal::create($req->except('_token'));
            DB::commit();
            return redirect('inwent-legal')->with('success','Inwent Legal successfully created');
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
        return view('inwentlegal::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $inwentlegal=InwentLegal::find($id);
        return view('inwentlegal::edit',compact('inwentlegal'));
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
            'effective_date'=>'required',
            'summary_of_changes'=>'required',
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            InwentLegal::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('inwent-legal')->with('success','Inwent Legal successfully Updated');
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
        InwentLegal::find($id)->delete();
        DB::commit();
         return redirect('inwent-legal')->with('success','Inwent Legal successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
