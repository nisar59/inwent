<?php

namespace CMS\BlogCategories\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\BlogCategories\Entities\BlogCategories;
use Throwable;
use DataTables;
use Auth;
use DB;
class BlogCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $categories=BlogCategories::orderBy('id','ASC')->get();
           return DataTables::of($categories)
           ->addColumn('action',function ($row){
               $action='';

            if(Auth::user()->can('blog-categories.edit')){
            $action.='<a href="javascript:void(0);" data-href="'.url('blog-categories/edit/'.$row->id).'" class="btn btn-sm btn-success m-1 edit-category"><i class="far fa-edit"></i></a>';
            }
            if(Auth::user()->can('blog-categories.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('blog-categories/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>'; 
           }
            if(Auth::user()->can('blogs.view')){
               $action.='<a class="btn btn-secondary btn-sm m-1" href="'.url('blogs/'.$row->id).'"><i class="fas fa-bars"></i></a>'; 
           }
               return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('blog-categories/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('blog-categories/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('blogcategories::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blogcategories::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'name'=>'required',
        ]);
        DB::beginTransaction();
        try{
            BlogCategories::create($req->except('_token'));
            DB::commit();
            return redirect('blog-categories')->with('success','Category successfully created');
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
        return view('categories::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $category=BlogCategories::find($id);
            $html=view('blogcategories::edit', compact('category'))->render();
            $resp=['success'=>true, 'message'=>'category successfully Fetched', 'data'=>$html];
            return response()->json($resp);
        } catch (Exception $e) {
            $resp=['success'=>false, 'message'=>'Something went wrong with this error :'.$e->getMessage(), 'data'=>null];
            return response()->json($resp);

        } catch (Exception $e){
            $resp=['success'=>false, 'message'=>'Something went wrong with this error :'.$e->getMessage(), 'data'=>null];
            return response()->json($resp);            
        }

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
        $category=BlogCategories::find($id);

        if($category->status==0){
            $category->status=1;
        }
        else{
            $category->status=0;
        }
        $category->save();
        DB::commit();
         return redirect('blog-categories')->with('success','Category status successfully updated');
         
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
            'name'=>'required',
        ]);
        DB::beginTransaction();
        try{
            BlogCategories::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('blog-categories')->with('success','Category successfully updated');
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
        BlogCategories::find($id)->delete();
        DB::commit();
         return redirect('blog-categories')->with('success','Category successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
