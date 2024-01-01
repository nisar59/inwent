<?php

namespace Network\Posts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\Posts\Entities\Posts;
use Throwable;
use DataTables;
use Auth;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $posts=Posts::with('user','media', 'reactions', 'comments')->orderBy('id','DESC')->get();

           return DataTables::of($posts)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('posts.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('/network/posts/show/'.$row->id).'"><i class="fas fa-eye"></i></a>';
            }
            if(Auth::user()->can('posts.delete')){
               $action='<a class="btn btn-danger btn-sm m-1" href="'.url('/network/posts/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })

           ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('/network/posts/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('/network/posts/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })

           ->addColumn('user_name',function ($row){
                if($row->user()->exists() && $row->user!=null){
                    return $row->user->name;
                }else{
                    return '<span class="text-danger">User Not Found</span>';
                }
           })
           ->addColumn('user_email',function ($row){
                if($row->user()->exists() && $row->user!=null){
                    return $row->user->email;
                }else{
                    return '<span class="text-danger">User Not Found</span>';
                }
           })

           ->editColumn('created_at',function ($row){
            return $row->created_at->format('d-m-y h:m a');
           })


           ->rawColumns(['action','status', 'user_name', 'user_email', 'created_at'])
           ->make(true);
        }
        return view('posts::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('posts::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('posts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('posts::edit');
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
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $post=Posts::find($id);

        if($post->status==0){
            $post->status=1;
        }
        else{
            $post->status=0;
        }
        $post->save();
        DB::commit();
         return redirect()->back()->with('success','Post status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
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
        Post::find($id)->delete();
        DB::commit();
         return redirect()->back()->with('success','Posts successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
