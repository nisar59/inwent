<?php

namespace CMS\Sliders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\Sliders\Entities\Sliders;
use Throwable;
use DataTables;
use Auth;
use DB;
class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $sliders=Sliders::orderBy('id','ASC')->get();
           return DataTables::of($sliders)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('sliders.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('sliders/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('sliders.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('sliders/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
           if(Auth::user()->can('sliders.edit')){
               $action.='<a class="btn btn-secondary btn-sm m-1" href="'.url('slider-images/create/'.$row->id).'"><i class="fas fa-sliders-h"></i></a>';
           }
               return $action;
           })->editColumn('actions',function ($row)
           {
                $actions=json_decode($row->actions);
               $actions_html='';
               if ($actions !=null AND  is_array($actions) AND count($actions)>0) {
                   foreach ($actions as $action) {
                    $actions_html.='<p class="m-0"><b>'.$action->text.': </b>'.$action->url.'</p>';
                   }
               }
               return $actions_html;

           })

           ->rawColumns(['action', 'actions'])
           ->make(true);
        }
        return view('sliders::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sliders::create');
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
        ]);
         DB::beginTransaction();
        try{
            $inputs=$req->except('_token');
            $inputs['actions']=json_encode($req->actions);
            Sliders::create($inputs);
            DB::commit();
            return redirect('sliders')->with('success','Slider successfully created');
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
        return view('sliders::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $sliders=Sliders::find($id);
        return view('sliders::edit',compact('sliders'));
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
        ]);
         DB::beginTransaction();
        try{
            $inputs=$req->except('_token');
            $inputs['actions']=json_encode($req->actions);
            Sliders::find($id)->update($inputs);
            DB::commit();
            return redirect('sliders')->with('success','Slider successfully updated');
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
        Sliders::find($id)->delete();
        DB::commit();
         return redirect('sliders')->with('success','Slider successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
