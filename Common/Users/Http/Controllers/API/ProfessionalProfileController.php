<?php

namespace Common\Users\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Users\Entities\ProfessionalProfile;
use Common\Users\Entities\ProfessionalProfileAwards;
use Throwable;
use Auth;
use DB;
class ProfessionalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
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
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileUpdate(Request $req)
    {
        $req->validate([
            'profile_status'=>'required',
            'regulatory_compliance'=>'required',
            'agree_to_terms'=>'required',
            'agree_to_get_offers'=>'required'
        ]);
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id()); 

            $professional_profile=ProfessionalProfile::firstOrNew(['user_id'=>$user_id]);

            $inputs=$req->except('skills_tags', 'skills_other_tags', 'tools_tags', 'tools_other_tags');

            $inputs['skills_tags']=json_encode($req->skills_tags);
            $inputs['skills_other_tags']=json_encode($req->skills_other_tags);
            $inputs['tools_tags']=json_encode($req->tools_tags);
            $inputs['tools_other_tags']=json_encode($req->tools_other_tags);



            $professional_profile->fill($inputs);
            $professional_profile->save();
            $data=[
                'user'=>Auth::user(),
                'professional_profile'=>$professional_profile
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileAwardsUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());

            /*Need to be changed start*/

            $ppa=ProfessionalProfileAwards::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }

            foreach($req->title as $key => $award){
                ProfessionalProfileAwards::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'title'=>$award,
                    'awarded_by'=>$req->awarded_by[$key],
                    'type'=>$req->type[$key],
                    'awarded_year'=>$req->awarded_year[$key],
                ]);
            }

            /*Need to be changed end*/

            $professional_profile=ProfessionalProfile::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile'=>$professional_profile
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
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
        //
    }
}
