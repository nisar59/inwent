<?php

namespace Common\Draft\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Draft\Entities\Draft;
use Throwable;
use Auth;
use DB;
class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('draft::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('draft::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {


        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $file_name=null;
            if($req->file!=null){

                $user_id=InwntDecrypt(Auth::id());
                $upload_path='users/'.md5($user_id).'/'.$req->file_path;
                if($req->hasFile('file')){
                    $file_name=FileUpload($req->file, $upload_path);
                }
                elseif(is_string($req->file)){
                    $file_name=Base64FileUpload($req->file, $upload_path);
                }else{
                    $res=['success'=>false,'message'=>'File could not Uploaded, because of wrong format','errors'=>[],'data'=>$data];
                    return response()->json($res);
                }

                Draft::create([
                    'user_id'=>$user_id,
                    'module'=>$req->module,
                    'component'=>$req->component,
                    'text_description'=>$req->text_description,
                    'media_file'=>$file_name,
                ]);
            }

            $data=[
                'file_name'=>$file_name,
            ];

            if($file_name!=null){
                $res=['success'=>true,'message'=>'File Uploaded successfully','errors'=>[],'data'=>$data];
            }else{
                $res=['success'=>false,'message'=>'File could not Uploaded','errors'=>[],'data'=>$data];
            }

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
        return view('draft::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('draft::edit');
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
