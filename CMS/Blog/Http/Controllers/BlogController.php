<?php

namespace CMS\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\Blog\Entities\Blog;
use Throwable;
use DataTables;
use Auth;
use DB;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $blog=Blog::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($blog)
           ->addColumn('action',function ($row){
               $action='';
            if(Auth::user()->can('blog.delete')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('blog/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
           if(Auth::user()->can('blog.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('blog/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }

               return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==0){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('blog/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('blog/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('blog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
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
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            Blog::create($req->except('_token'));
            DB::commit();
            return redirect('blog')->with('success','Blog successfully created');
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
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $blog=Blog::find($id);
        return view('blog::edit',compact('blog'));
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
        $blog=Blog::find($id);

        if($blog->status==1){
            $blog->status=0;
        }
        else{
            $blog->status=1;
        }
        $blog->save();
        DB::commit();
         return redirect('blog')->with('success','Blog status successfully updated');
         
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
            'slug'=>'required',
            'description'=>'required',
        ]);
        DB::beginTransaction();
        try{
            Blog::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('blog')->with('success','Blog successfully updated');
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
        Blog::find($id)->delete();
        DB::commit();
         return redirect('blog')->with('success','Blog successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
