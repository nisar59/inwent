<?php

namespace CMS\KnowledgeBaseCategories\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\KnowledgeBaseCategories\Entities\KnowledgeBaseCategories;
use Throwable;
use DataTables;
use Auth;
use DB;
class KnowledgeBaseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $knowledge_base_categories=KnowledgeBaseCategories::orderBy('id','ASC')->get();
           return DataTables::of($knowledge_base_categories)
           ->addColumn('action',function ($row){
               $action='';
            if(Auth::user()->can('knowledge-base-categories.delete')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('knowledge-base-categories/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
           if(Auth::user()->can('knowledge-base-categories.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('knowledge-base-categories/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }

               return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('knowledge-base-categories/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('knowledge-base-categories/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('knowledgebasecategories::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('knowledgebasecategories::create');
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
            'icon'=>'required',
            'description'=>'required'
        ]);
        DB::beginTransaction();
        try{
            $path='cms/knowledge-base-categories';

            $inputs=$req->except('_token', 'icon');
            if($req->icon!=null){
                $inputs=FileUpload($req->file, $path);
            }
            KnowledgeBaseCategories::create($inputs);
            DB::commit();
            return redirect('knowledge-base-categories')->with('success','Knowledge Base Category successfully created');
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
        return view('knowledgebasecategories::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $knowledge_base_cate=KnowledgeBaseCategories::find($id);
        return view('knowledgebasecategories::edit',compact('knowledge_base_cate'));
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
        $blog=KnowledgeBaseCategories::find($id);

        if($blog->status==0){
            $blog->status=1;
        }
        else{
            $blog->status=0;
        }
        $blog->save();
        DB::commit();
         return redirect('knowledge-base-categories')->with('success','Knowledge Base Category status successfully updated');
         
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
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            $path='cms/knowledge-base-categories';

            $inputs=$req->except('_token', 'icon');
            if($req->icon!=null){
                $inputs=FileUpload($req->file, $path);
            }

            KnowledgeBaseCategories::find($id)->update($inputs);
            DB::commit();
            return redirect('knowledge-base-categories')->with('success','Knowledge Base Category successfully Updated');
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
        KnowledgeBaseCategories::find($id)->delete();
        DB::commit();
         return redirect('knowledge-base-categories')->with('success','Knowledge Base Category successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
