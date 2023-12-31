<?php

namespace Network\Boards\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\BoardsCategories\Entities\BoardsCategories;
use Network\Boards\Entities\Boards;
use Throwable;
use Auth;
use DB;
use Str;
class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $req)
    {
        $user_id=InwntDecrypt(Auth::id());

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          

            $boards=Boards::where(['status'=>1]);

            if($req->search_term!=null || $req->search_term!=""){
                $boards->where('title', 'LIKE', '%'.$req->search_term.'%');
            }
            if($req->category_id!=null){
                 $boards->where('category_id', $req->category_id);
            }

            if($req->sub_category_id!=null){
                 $boards->where('sub_category_id', $req->sub_category_id);
            }

            $boards=$boards->get();
            $data=[
                'boards'=>$boards,
            ];

            $res=['success'=>true,'message'=>'Boards successfully fetched','errors'=>[],'data'=>$data];
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
    public function clipBySlug($slug)
    {
        $user_id=InwntDecrypt(Auth::id());

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          

            $clip=Boards::where(['status'=>1])->where('slug', 'LIKE', '%'.$slug.'%')->first();

           if($clip==null){
            $res=['success'=>false,'message'=>'Boards Clip Not Found','errors'=>[],'data'=>null];
             return response()->json($res);
           }

            $boards=Boards::where(['status'=>1])->where('category_id', $clip->category_id)->get();

            $data=[
                'boards'=>$boards,
                'clip'=>$clip,
            ];

            $res=['success'=>true,'message'=>'Boards successfully fetched','errors'=>[],'data'=>$data];
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
    public function categories()
    {
        $user_id=InwntDecrypt(Auth::id());

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          

            $categories=BoardsCategories::where(['status'=>1, 'parent_id'=>null])->get();

            $data=[
                'categories'=>$categories,
            ];

            $res=['success'=>true,'message'=>'Boards categories successfully fetched','errors'=>[],'data'=>$data];
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
            $inputs=$req->all();
            $inputs['user_id']=$user_id;
            $inputs['slug']=Str::slug($req->title);
            $inputs['status']=1;
            Boards::create($inputs);

            $res=['success'=>true,'message'=>'Boards Clip successfully posted','errors'=>[],'data'=>null];
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
        return view('boards::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('boards::edit');
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
        //
    }
}
