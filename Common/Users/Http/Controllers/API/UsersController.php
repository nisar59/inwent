<?php

namespace Common\Users\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Users\Entities\BasicProfile;
use Common\Users\Entities\BusinessProfile;
use Common\Users\Entities\InvestorProfile;
use Common\Languages\Entities\Languages;
use Common\Countries\Entities\Countries;
use App\Models\User;
use Hash;
use Auth;
use DB;
use Throwable;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('users::index');
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

    public function basicProfile()
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $basic_profile=BasicProfile::where(['user_id'=>$user_id])->first();
            $countries=Countries::all();
            $languages=Languages::all();


            $data=[
                'user'=>Auth::user(),
                'countries'=>$countries,
                'languages'=>$languages,
                'basic_profile'=>$basic_profile
            ];

            $res=['success'=>true,'message'=>'Basic profile successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }


    public function basicProfileBySlug($slug)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user=User::where('slug', $slug)->first(); 

            if($user==null){
            $res=['success'=>true,'message'=>'User not found','errors'=>[],'data'=>null];

            }else{
                $basic_profile=BasicProfile::where(['user_id'=>$user->id])->first();

                $data=[
                    'user'=>$user,
                    'basic_profile'=>$basic_profile
                ];

                $res=['success'=>true,'message'=>'Basic profile successfully fetched','errors'=>[],'data'=>$data];
            }

             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }



    public function basicProfileUpdate(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $basic_profile=BasicProfile::firstOrNew(['user_id'=>$user_id]);
            $inputs=$req->except('profile_tages', 'interests', 'social_links');
            $inputs['profile_tages']=json_encode($req->profile_tages);
            $inputs['interests']=json_encode($req->interests);
            $inputs['social_links']=json_encode($req->social_links);


            $basic_profile->fill($inputs);
            $basic_profile->save();

            $user_inputs=$req->only('first_name', 'last_name');
            $user_inputs['name']=$req->first_name.' '.$req->last_name;

            Auth::user()->update($user_inputs);
            

            $data=[
                'user'=>Auth::user(),
                'basic_profile'=>$basic_profile
            ];

            $res=['success'=>true,'message'=>'Basic profile successfully updated','errors'=>[],'data'=>$data];
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


    public function UserImageUpdate(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user=Auth::user();

            if($req->image!=null){
                $user->image=FileUpload($req->image, 'users/avatar');
                $user->save();
            }

            $data=[
                'user'=>Auth::user(),
            ];

            $res=['success'=>true,'message'=>'Profile Image successfully updated','errors'=>[],'data'=>$data];
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



    public function UserPasswordUpdate(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          

            $user=Auth::user();

            if($req->new_password!=$req->confirm_password){
                $res=['success'=>false,'message'=>'New password do not match with confirm password','errors'=>[],'data'=>null];
            }elseif(!Hash::check($req->current_password, auth()->user()->password)){
                $res=['success'=>false,'message'=>'Current password is wrong','errors'=>[],'data'=>null];
            }else{

                $user->password=Hash::make($req->new_password);
                $user->save();
                $data=[
                    'user'=>Auth::user(),
                ];
                $res=['success'=>true,'message'=>'You password successfully updated','errors'=>[],'data'=>$data];
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


    public function businessProfile()
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $business_profile=BusinessProfile::where(['user_id'=>$user_id])->first();
            $countries=Countries::all();

            $data=[
                'user'=>Auth::user(),
                'business_profile'=>$business_profile,
                'countries'=>$countries,
            ];

            $res=['success'=>true,'message'=>'Business profile successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }



    public function businessProfileUpdate(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $business_profile=BusinessProfile::firstOrNew(['user_id'=>$user_id]);

            $business_profile->fill($req->all());
            $business_profile->save();
            $data=[
                'user'=>Auth::user(),
                'business_profile'=>$business_profile
            ];

            $res=['success'=>true,'message'=>'Business profile successfully updated','errors'=>[],'data'=>$data];
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




    public function investorProfile()
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $investor_profile=InvestorProfile::where(['user_id'=>$user_id])->first();
            $countries=Countries::all();
            $languages=Languages::all();

            $data=[
                'user'=>Auth::user(),
                'investor_profile'=>$investor_profile,
                'countries'=>$countries,
                'languages'=>$languages,
            ];

            $res=['success'=>true,'message'=>'Investor profile successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }





    public function investorProfileUpdate(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $investor_profile=InvestorProfile::firstOrNew(['user_id'=>$user_id]);

            $investor_profile->fill($req->all());
            $investor_profile->save();
            $data=[
                'user'=>Auth::user(),
                'investor_profile'=>$investor_profile
            ];

            $res=['success'=>true,'message'=>'Investor profile successfully updated','errors'=>[],'data'=>$data];
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
