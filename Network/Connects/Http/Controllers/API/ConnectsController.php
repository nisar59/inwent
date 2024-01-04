<?php

namespace Network\Connects\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\Connects\Entities\Connects;
use App\Models\UserRatings;
use App\Models\User;
use Throwable;
use Auth;
use DB;
class ConnectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(){ 
        $user_id=InwntDecrypt(Auth::id());

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          

            $invitations_ids=Connects::where(['target_id'=>$user_id,'status'=>0])->pluck('source_id');

            $targets=Connects::where(['source_id'=> $user_id, 'status'=>1])->pluck('target_id')->toArray();

            $sources=Connects::where(['target_id'=> $user_id, 'status'=>1])->pluck('source_id')->toArray();

            $connects_ids=array_merge($targets, $sources);
            $distinct=array_unique($connects_ids);

            $invitations=User::with('basicProfile')->whereIn('id', $invitations_ids)->get();
            $connects=User::with('basicProfile')->whereIn('id', $distinct)->get();


            $data=[
                'invitations'=>$invitations,
                'connects'=>$connects,
                'user_id'=>$user_id
            ];

            $res=['success'=>true,'message'=>'Users successfully fetched','errors'=>[],'data'=>$data];
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

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req){
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());
            if($req->target_id==null){
                $res=['success'=>false,'message'=>'Something went wrong, refresh and try again','errors'=>[],'data'=>null];
            }else{

                $existing_target=Connects::where(['source_id'=>$user_id, 'target_id'=>$req->target_id]);

                $existing_source=Connects::where(['source_id'=>$req->target_id, 'target_id'=>$user_id]);

                if($existing_target->count()>0 OR $existing_source->count()>0){
                    $res=['success'=>true,'message'=>'He is already in your friend list','errors'=>[],'data'=>null];
                }else{

                    Connects::create([
                        'source_id'=>$user_id,
                        'target_id'=>$req->target_id,
                    ]);

                    $res=['success'=>true,'message'=>'Invitation successfully sent','errors'=>[],'data'=>null];

                }

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
        return view('connects::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('connects::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req){
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());
            if($req->source_id==null){
                $res=['success'=>false,'message'=>'Something went wrong, refresh and try again','errors'=>[],'data'=>null];
            }else{

                $connect=Connects::where(['source_id'=>$req->source_id, 'target_id'=>$user_id])->first();

                if($connect==null){
                    $res=['success'=>false,'message'=>'Something went wrong, refresh and try again','errors'=>[],'data'=>null];
                }else{

                    $connect->update(['status'=>$req->status]);

                    if($req->status==1){
                        $res=['success'=>true,'message'=>'Invitation successfully Accepted','errors'=>[],'data'=>null];
                    }else{
                        $res=['success'=>true,'message'=>'Invitation successfully Declined','errors'=>[],'data'=>null];
                    }

                }

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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id){
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $existing_target=Connects::where(['source_id'=>$user_id, 'target_id'=>$id]);

            if($existing_target->count()>0){

                $existing_target->delete();

                $res=['success'=>true,'message'=>'Invitation successfully cancled','errors'=>[],'data'=>null];

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




    public function search(Request $req){
        
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {       
            $user_id=InwntDecrypt(Auth::id());   
            $users=User::with('basicProfile')->whereHas('basicProfile')->whereNot('id', $user_id)->where('status', 1)->where('name','LIKE', '%'.$req->q.'%')->get();

            $target_id=Connects::where(['source_id'=>$user_id, 'status'=>0])->get('target_id')->toArray();
            $source_id=Connects::where(['target_id'=>$user_id, 'status'=>0])->get('source_id')->toArray();

            $connects=array_merge($source_id, $target_id);

            $data=[
                'users'=>$users,
                'connects'=>$connects
            ];

            $res=['success'=>true,'message'=>'Users successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }





    public function ratingConnects(){
        
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id());
            $targets=Connects::where(['source_id'=> $user_id, 'status'=>1])->pluck('target_id')->toArray();
            $sources=Connects::where(['target_id'=> $user_id, 'status'=>1])->pluck('source_id')->toArray();

            $connects_ids=array_merge($targets, $sources);
            $distinct=array_unique($connects_ids);
            $connects=User::with('basicProfile')->whereIn('id', $distinct)->get();

            $rating_connects=UserRatings::where('user_from', $user_id)->pluck('user_to')->toArray();

            $data=[
                'rating_connects'=>$rating_connects,
                'connects'=>$connects
            ];

            $res=['success'=>true,'message'=>'Users successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }


    public function inviteConnect(Request $req){

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {

            $user_id=InwntDecrypt(Auth::id());
            $check_exist=UserRatings::where(['user_from'=>$user_id, 'user_to'=>$req->target_id])->first();
            if($check_exist==null){
                UserRatings::create([
                    'user_from'=>$user_id,
                    'user_to'=>$req->target_id,
                    'status'=>0,
                    'total_rating_given'=>0,
                    'field_knowledge'=>0,
                    'subject_knowledge'=>0,
                    'skills'=>0,
                    'qualification'=>0,
                    'experience'=>0,
                    'achievements'=>0,
                    'community_participation'=>0,
                    'survey_participation'=>0
                ]);
            }

            $targets=Connects::where(['source_id'=> $user_id, 'status'=>1])->pluck('target_id')->toArray();
            $sources=Connects::where(['target_id'=> $user_id, 'status'=>1])->pluck('source_id')->toArray();

            $connects_ids=array_merge($targets, $sources);
            $distinct=array_unique($connects_ids);
            $connects=User::with('basicProfile')->whereIn('id', $distinct)->get();

            $rating_connects=UserRatings::where('user_from', $user_id)->pluck('user_to')->toArray();

            $data=[
                'rating_connects'=>$rating_connects,
                'connects'=>$connects
            ];

            $res=['success'=>true,'message'=>'Invitation successfully sent','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                DB::rollback();
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                DB::rollback();
                return response()->json($res);
        }
    }





    public function ratingInvitations(){
        
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id());
            $invitations=UserRatings::where(['user_to'=> $user_id])->get();

            $data=[
                'invitations'=>$invitations,
            ];

            $res=['success'=>true,'message'=>'rating invitations successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }
    }



    public function ratingInvitationUpdate(Request $req){
        
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $invitation=UserRatings::find($req->id);
            if($invitation==null){
                $res=['success'=>false,'message'=>'rating invitations not found','errors'=>[],'data'=>null];
                return response()->json($res);
            }
            $inputs=$req->except('id');

            $sum=(int) $req->field_knowledge + (int) $req->subject_knowledge + (int) $req->skills + (int) $req->qualification + (int) $req->experience + (int) $req->achievements + (int) $req->community_participation+ (int) $req->survey_participation;

            $total=($sum/90)*10;

            $inputs['total_rating_given']=$total;

            $invitation->update($inputs);

            $res=['success'=>true,'message'=>'rating invitations successfully updated','errors'=>[],'data'=>null];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                 DB::rollback();
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                 DB::rollback();
                return response()->json($res);
        }
    }




}
