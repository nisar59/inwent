<?php

namespace Network\BoardsCategories\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\BoardsCategories\Entities\BoardsCategories;
use Throwable;
use DataTables;
use Auth;
use DB;
use Str;
class BoardsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $categories=BoardsCategories::orderBy('id','ASC')->get();
           return DataTables::of($categories)
           ->addColumn('action',function ($row){
               $action='';

            if(Auth::user()->can('boards-categories.edit')){
            $action.='<a href="javascript:void(0);" data-href="'.url('network/boards-categories/edit/'.$row->id).'" class="btn btn-sm btn-success m-1 edit-category"><i class="far fa-edit"></i></a>';
            }
            if(Auth::user()->can('boards-categories.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('network/boards-categories/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>'; 
           }
            
            return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('network/boards-categories/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('network/boards-categories/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('boardscategories::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('boardscategories::create');
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
            $inputs['slug']=Str::slug($req->title);
            $inputs['status']=1;
            BoardsCategories::create($inputs);
            DB::commit();
            return redirect('network/boards-categories')->with('success','Category successfully created');
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
            $category=BoardsCategories::find($id);
            $html=view('boardscategories::edit', compact('category'))->render();
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
        $category=BoardsCategories::find($id);

        if($category->status==0){
            $category->status=1;
        }
        else{
            $category->status=0;
        }
        $category->save();
        DB::commit();
         return redirect('network/boards-categories')->with('success','Category status successfully updated');
         
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
            'title'=>'required',
        ]);
        DB::beginTransaction();
        try{
            $inputs=$req->except('_token');
            $inputs['slug']=Str::slug($req->title);
            BoardsCategories::find($id)->update($inputs);
            DB::commit();
            return redirect('network/boards-categories')->with('success','Category successfully updated');
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
        BoardsCategories::find($id)->delete();
        DB::commit();
         return redirect('network/boards-categories')->with('success','Category successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

}
