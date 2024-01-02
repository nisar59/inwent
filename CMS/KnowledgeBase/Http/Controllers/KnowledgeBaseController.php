<?php

namespace CMS\KnowledgeBase\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\KnowledgeBase\Entities\KnowledgeBase;
use CMS\KnowledgeBaseCategories\Entities\KnowledgeBaseCategories;
use Throwable;
use DataTables;
use Auth;
use DB;
class KnowledgeBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $knowledge_base=KnowledgeBase::orderBy('id','ASC')->get();
           return DataTables::of($knowledge_base)
           ->addColumn('action',function ($row){
               $action='';
            if(Auth::user()->can('knowledge-base.delete')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('knowledge-base/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
           if(Auth::user()->can('knowledge-base.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('knowledge-base/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }

               return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('knowledge-base/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('knowledge-base/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->addColumn('knowledge_base_category_id',function ($row)
           {
            if($row->category()->exists() && $row->category!=null){
              return $row->category->title;
            }
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('knowledgebase::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $knowledge_base_cate=KnowledgeBaseCategories::where('status',1)->get();
        return view('knowledgebase::create',compact('knowledge_base_cate'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'knowledge_base_category_id'=>'required',
            'title'=>'required',
            'short_description'=>'required',
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            KnowledgeBase::create($req->except('_token'));
            DB::commit();
            return redirect('knowledge-base')->with('success','Knowledge Base successfully created');
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
        return view('knowledgebase::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $knowledge_base=KnowledgeBase::find($id);
        $knowledge_base_cate=KnowledgeBaseCategories::where('status',0)->get();
        return view('knowledgebase::edit',compact('knowledge_base','knowledge_base_cate'));
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
        $blog=KnowledgeBase::find($id);

        if($blog->status==0){
            $blog->status=1;
        }
        else{
            $blog->status=0;
        }
        $blog->save();
        DB::commit();
         return redirect('knowledge-base')->with('success','Knowledge Base status successfully updated');
         
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
            'knowledge_base_category_id'=>'required',
            'title'=>'required',
            'short_description'=>'required',
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            KnowledgeBase::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('knowledge-base')->with('success','Knowledge Base successfully Updated');
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
        KnowledgeBase::find($id)->delete();
        DB::commit();
         return redirect('knowledge-base')->with('success','Knowledge Base successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
