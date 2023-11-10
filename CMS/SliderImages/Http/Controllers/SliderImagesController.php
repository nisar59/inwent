<?php

namespace CMS\SliderImages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\SliderImages\Entities\SliderImages;
use Throwable;
use DataTables;
use Auth;
use DB;
class SliderImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $slider=SliderImages::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($slider)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('slider-images/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->addColumn('image', function ($row) {
                    return '<img src="'.StorageFile($row->image).'" height="50" width="50">';
                })
           ->rawColumns(['action','image'])
           ->make(true);
        }
        return view('sliderimages::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sliderimages::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'images'=>'required',
            'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg,|max:3048',
        ]);
        $path='cms/slider';
        DB::beginTransaction();
        try{
        if($req->images!=null){
             foreach ($req->images as $img) {
                SliderImages::create([
                    'slider_id'=>$req->slider_id,
                    'image'=>FileUpload($img,$path),
                ]);
             }
        }
        DB::commit();
         return redirect('slider-images')->with('success','Slider Images successfully created');
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
        return view('sliderimages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sliderimages::edit');
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
        SliderImages::find($id)->delete();
        DB::commit();
         return redirect('slider-images')->with('success','Slider Image successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
