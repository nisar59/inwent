<?php

namespace Network\Posts\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\SponsoredPosts\Entities\SponsoredPosts;
use Network\Posts\Entities\Posts;
use Network\Posts\Entities\Comments;
use Network\Posts\Entities\Reactions;
use Network\Posts\Entities\Media;
use Network\Posts\Entities\Events;
use Throwable;
use Auth;
use Str;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $posts=Posts::with('user','media', 'reactions', 'comments')->where('status', 1)->latest()->get();
            $sponsored_posts=SponsoredPosts::where('status', 1)->latest()->get();

            $posts=array_merge($posts, $sponsored_posts);
            shuffle($posts);
            $data=[
                'posts'=>$posts,
                'sponsored_posts'=>$sponsored_posts
            ];

            $res=['success'=>true,'message'=>'Posts successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function postBySlug($slug)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $post=Posts::with('user','media', 'reactions', 'comments')->where('slug', $slug)->first();

            $data=[
                'post'=>$post,
            ];

            $res=['success'=>true,'message'=>'Posts successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }




    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function recent()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $posts=Posts::whereNot('post_description',null)->latest()->limit(5)->get();
            $data=[
                'posts'=>$posts,
            ];

            $res=['success'=>true,'message'=>'Posts successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
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
    public function store(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user_id=InwntDecrypt(Auth::id());

            $inputs=$req->only('post_description');
            $inputs['user_id']=$user_id;

            $slug=uniqid().'-'.Auth::user()->slug.'-network-post'.'-'.now()->timestamp;
            $inputs['slug'] = Str::slug($slug);
            $inputs['status']=1;


            $post=Posts::create($inputs);

            if(count($req->media)>0){
                foreach ($req->media as $key => $mda) {
                    $mda['post_id']=$post->id;
                    Media::create($mda);
                }
            }

            $data=[
                'posts'=>$post,
            ];

            $res=['success'=>true,'message'=>'Posts successfully created','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
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
    public function update(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user_id=InwntDecrypt(Auth::id());

            $inputs=$req->only('post_description');

            Posts::find($id)->update($inputs);


            $res=['success'=>true,'message'=>'Posts successfully updated','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            Posts::find($id)->delete();

            $res=['success'=>true,'message'=>'Posts successfully deleted','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }

    }


    public function commentStore(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user_id=InwntDecrypt(Auth::id());

            $inputs=$req->only('post_id','parent_comment_id','comment_description');
            $inputs['user_id']=$user_id;

            Comments::create($inputs);

            $res=['success'=>true,'message'=>'Comment successfully posted','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }

    public function commentUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $inputs=$req->only('comment_description');

            Comments::find($id)->update($inputs);

            $res=['success'=>true,'message'=>'Comment successfully updated','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }

    public function commentDestroy($id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            Comments::find($id)->delete();

            $res=['success'=>true,'message'=>'Comment successfully deleted','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }

    public function reactionUpdated(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user_id=InwntDecrypt(Auth::id());

            $inputs=$req->only('post_id','reaction');
            $inputs['user_id']=$user_id;

            $reaction=Reactions::where(['post_id'=>$req->post_id, 'user_id'=>$user_id]);
            if($reaction->count()>0){
                $reaction->delete();
            }else{
                Reactions::create($inputs);
             }
            $res=['success'=>true,'message'=>'Reactions successfully updated','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }

    }

    public function reactionDestroy(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user_id=InwntDecrypt(Auth::id());

            $inputs=$req->only('post_id');
            $inputs['user_id']=$user_id;

            Reactions::where($inputs)->delete();

            $res=['success'=>true,'message'=>'Reactions successfully removed','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
 
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function allEvents()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $events=Events::latest()->get();
            $data=[
                'events'=>$events
            ];

            $res=['success'=>true,'message'=>'Events successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }



    public function eventStore(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user_id=InwntDecrypt(Auth::id());

            $inputs=$req->only('event_name','event_poster','event_start_date','event_end_date', 'event_description');
            $inputs['user_id']=$user_id;

            Events::create($inputs);

            $res=['success'=>true,'message'=>'Event successfully created','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
            DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }



}
