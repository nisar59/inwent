<?php

namespace Network\SponsoredPosts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\SponsoredPosts\Entities\SponsoredPosts;
use Throwable;
use DataTables;
use Auth;
use DB;
class SponsoredPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $posts=SponsoredPosts::orderBy('id','DESC')->get();

           return DataTables::of($posts)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('sponsored-posts.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('/network/sponsored-posts/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('sponsored-posts.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('/network/sponsored-posts/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->editColumn('corporation_business_avatar', function($row){
              return '<img width="50" height="50" class="rounded-circle" src="'.$row->corporation_business_avatar.'">';
           })
           ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('/network/sponsored-posts/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('/network/sponsored-posts/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })

           ->rawColumns(['action','status','corporation_business_avatar'])
           ->make(true);
        }
        return view('sponsoredposts::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sponsoredposts::create');
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
        'corporation_business_name'=>'required',
        'corporation_business_avatar'=>'required',
        'media'=>'required'
       ]);
        DB::beginTransaction();
        try{
            $inputs=$req->except('_token', 'corporation_business_avatar', 'media');
            $path='network/sponsored-posts';

            if($req->corporation_business_avatar!=null){
                $inputs['corporation_business_avatar']=FileUpload($req->corporation_business_avatar, $path);
            }

            if($req->media!=null){

                $file_type=$req->file('media')->getMimeType();

                if(str_contains($file_type, 'image')){
                    $inputs['media_type']=0;
                }elseif(str_contains($file_type, 'video')){                    
                    $inputs['media_type']=1;
                }else{
                 return redirect()->back()->with('warning','Media file only could be a video or image file');
                }

                $inputs['media']=FileUpload($req->media, $path);
            }


            SponsoredPosts::create($inputs);

            DB::commit();
            return redirect('/network/sponsored-posts')->with('success','Professional Skill successfully created');
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
        return view('professionalskills::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $post=SponsoredPosts::find($id);   
        return view('sponsoredposts::edit',compact('post'));
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
        $post=SponsoredPosts::find($id);

        if($post->status==0){
            $post->status=1;
        }
        else{
            $post->status=0;
        }
        $post->save();
        DB::commit();
         return redirect('sponsored-posts')->with('success','Sponsored Post status successfully updated');
         
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
        'corporation_business_name'=>'required',
       ]);
        DB::beginTransaction();
        try{
            $inputs=$req->except('_token', 'corporation_business_avatar', 'media');
            $path='network/sponsored-posts';

            if($req->corporation_business_avatar!=null){
                $inputs['corporation_business_avatar']=FileUpload($req->corporation_business_avatar, $path);
            }

            if($req->media!=null){

                $file_type=$req->file('media')->getMimeType();

                if(str_contains($file_type, 'image')){
                    $inputs['media_type']=0;
                }elseif(str_contains($file_type, 'video')){                    
                    $inputs['media_type']=1;
                }else{
                 return redirect()->back()->with('warning','Media file only could be a video or image file');
                }

                $inputs['media']=FileUpload($req->media, $path);
            }


            SponsoredPosts::find($id)->update($inputs);

            DB::commit();
            return redirect('/network/sponsored-posts')->with('success','Sponsored Post successfully updated');
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
        SponsoredPosts::find($id)->delete();
        DB::commit();
         return redirect('/network/sponsored-posts')->with('success','Sponsored Posts successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

}
