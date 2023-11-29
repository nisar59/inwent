<?php

namespace Common\Messages\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Messages\Entities\Threads;
use Common\Messages\Entities\Messages;
use App\Models\User;
use Throwable;
use Auth;
use DB;
class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($module)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $sender=Threads::where(['sender_id'=>$user_id, 'module'=>$module])->pluck('id')->toArray();

            $receiver=Threads::where(['receiver_id'=>$user_id, 'module'=>$module])->pluck('id')->toArray();

            $threads_ids=array_merge($sender, $receiver);
            $distinct=array_unique($threads_ids);

            $threads=Threads::whereIn('id', $distinct)->get();

            $data=[
                'threads'=>$threads
            ];

            $res=['success'=>true,'message'=>'Thread successfully fetched','errors'=>[],'data'=>$data];

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
    public function messages($thread)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $messages=Messages::where(['thread_id'=>$thread])->get();
            $data=[
                'messages'=>$messages
            ];

            $res=['success'=>true,'message'=>'messages successfully fetched','errors'=>[],'data'=>$data];

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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function updateFcm(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            Auth::user()->update(['fcm_token'=>$req->fcm_token]);

            $res=['success'=>true,'message'=>'FCM token successfully updated','errors'=>[],'data'=>null];

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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function createThread(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            Threads::create([
                'sender_id'=>$user_id,
                'receiver_id'=>$req->receiver_id,
                'module'=>$req->module
            ]);

            $res=['success'=>true,'message'=>'Thread successfully created','errors'=>[],'data'=>null];

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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeMessage(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $thread=null;

            $sender=Threads::where(['sender_id'=>$user_id, 'receiver_id'=>$req->receiver_id, 'module'=>$req->module])->first();

            $receiver=Threads::where(['sender_id'=>$req->receiver_id, 'receiver_id'=>$user_id, 'module'=>$req->module])->first();

            if($sender!=null){
                $thread=$sender;
            }elseif ($receiver!=null) {
                $thread=$receiver;
            }else{
                $thread=Threads::create(['sender_id'=>$user_id, 'receiver_id'=>$req->receiver_id, 'module'=>$req->module]);
            }

            Messages::create([
                'thread_id'=>$thread->id,
                'sender_id'=>$user_id,
                'message_type'=>$req->message_type,
                'content'=>$req->content
            ]);

            $fcms=User::where('id', $req->receiver_id)->pluck('fcm_token')->toArray();

            $response=Larafirebase::withTitle(Auth::user()->name)
            ->withBody($req->content)
            ->withImage(Settings()->website_logo)
            ->withIcon(Settings()->website_logo)
            ->withSound('default')
            ->withClickAction(url('home'))
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
            ])
            ->sendNotification($fcms);


            $res=['success'=>true,'message'=>'Message successfully sent','errors'=>[],'data'=>$response];

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
        return view('messages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('messages::edit');
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
