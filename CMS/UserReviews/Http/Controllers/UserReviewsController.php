<?php

namespace CMS\UserReviews\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\UserReviews\Entities\UserReviews;
use Throwable;
use DataTables;
use Auth;
use DB;
class UserReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $userreviews=UserReviews::orderBy('id','ASC')->get();
           return DataTables::of($userreviews)
           ->addColumn('action',function ($row){
               $action='';
                if(Auth::user()->can('user-reviews.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('user-reviews/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('user-reviews.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('user-reviews/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('image', function ($row) {
                    return '<img src="'.StorageFile($row->image).'" height="50" width="50">';
                })
           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('user-reviews/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('user-reviews/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','image','status'])
           ->make(true);
        }
        return view('userreviews::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('userreviews::create');
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
            'designation'=>'required',
            'image'=>'required',
            'review'=>'required',
        ]);
         DB::beginTransaction();
        try{
            $path='cms/user-Reviews';
            $inputs=$req->except('_token');
            $inputs['image']=FileUpload($req->image,$path);
            UserReviews::create($inputs);
            DB::commit();
            return redirect('user-reviews')->with('success','User Review successfully created');
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
        return view('userreviews::show');
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
        $status=UserReviews::find($id);

        if($status->status==0){
            $status->status=1;
        }
        else{
            $status->status=0;
        }
        $status->save();
        DB::commit();
         return redirect('user-reviews')->with('success','User Review status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $userreviews=UserReviews::find($id);
        return view('userreviews::edit',compact('userreviews'));
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
            'designation'=>'required',
            'review'=>'required',
        ]);
         DB::beginTransaction();
        try{
            $path='cms/user-Reviews';
            $inputs=$req->except('_token');
            if($req->image!=null){
                $inputs['image']=FileUpload($req->image, $path);
            }
            UserReviews::find($id)->update($inputs);
            DB::commit();
            return redirect('user-reviews')->with('success','User Review successfully Updated');
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
        UserReviews::find($id)->delete();
        DB::commit();
         return redirect('user-reviews')->with('success','User Review successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
