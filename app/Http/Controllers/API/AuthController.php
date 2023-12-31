<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Throwable;
use Validator;
use Auth;
use DB;
use Str;
class AuthController extends Controller
{
    function __construct()
    {
        auth()->setDefaultDriver('user');
    }
    public function register(Request $req)
    {
        $res=['success'=>true,'message'=>null,'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {
            $val = Validator::make($req->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($val->fails()) {
                $res=['success'=>false,'message'=>'Required fields are missing','errors'=>$val->messages()->all(),'data'=>null];
                return response()->json($res);
            }

            $inputs=$req->all();
            $slug = Str::slug($req->name);

            if (User::whereSlug($slug)->exists()) {
                $inputs['slug']=$slug."-".rand(10, 10000);
            }
            
            $inputs['slug']=$slug;
            $inputs['name']=$req->first_name.' '.$req->last_name;


           $user=User::create($inputs);
           $data=[
            'user'=>$user,
           ];
           $res=['success'=>true,'message'=>'User successfully registered, a verification link has been sent to your email. Please verify your email before proceeding','errors'=>[],'data'=>$data];
           $user->sendEmailVerificationNotification();
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


    public function verify($id, Request $req) {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          

            $user = User::findOrFail(base64_decode($id));

            if ($user!=null && $user->link_expire_time>now() && $user->email==base64_decode($req->hash)) {
                $user->markEmailAsVerified();
                $res=['success'=>true,'message'=>'Your email has been successfully verified', 'errors'=>[],'data'=>null];
            }else{
                $res=['success'=>false,'message'=>'Invalid or expired url provided', 'errors'=>[],'data'=>null];
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

    public function resend($id) {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {
          
          $user=User::findOrFail(InwntDecrypt($id));
          if($user==null){
            $res=['success'=>false,'message'=>'Something went wrong','errors'=>[],'data'=>null];
            return response()->json($res);
          }else{
            if($user->hasVerifiedEmail()){
            $res=['success'=>true,'message'=>'Your email is already verified','errors'=>[],'data'=>['user'=>$user]];
            }else{
                $user->sendEmailVerificationNotification();
                $res=['success'=>true,'message'=>'An email verification link has been sent to your email.','errors'=>[],'data'=>null];
            }
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



    public function login(Request $req)
    {   

        $res=['success'=>true,'message'=>null,'errors'=>[],'data'=>null];

        try {
            $val = Validator::make($req->all(),[
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

           

            if ($val->fails()) {
                $res=['success'=>false,'message'=>'Required Fields are missing','errors'=>$val->messages()->all(),'data'=>null];
            }

            elseif(!$token = Auth::attempt($req->all()))
            {
                $res=['success'=>false,'message'=>'Unauthorized, email or password is wrong','errors'=>[],'data'=>null];
            }
            elseif(!Auth::user()->hasVerifiedEmail()){
                Auth::user()->sendEmailVerificationNotification();
                 Auth::logout();
                $res=['success'=>false,'message'=>'Authentication failed, Your account is not verified, check your email account and verify your email before proceeding','errors'=>[],'data'=>null]; 
            }
            elseif(Auth::user()->status==0){
                $this->logout();
                $res=['success'=>false,'message'=>'Authentication failed, Your account is blocked','errors'=>[],'data'=>null];
            }
            else{
                $user = Auth::user();
                $user['access_token']=$token;
                $res=['success'=>true,'message'=>'Authentication Successfull','errors'=>[],'data'=>$user];
            }

            return response()->json($res);

            
            } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

            } catch (Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);


            }

    }



public function refresh()
    {
        $res=['success'=>true,'message'=>null,'errors'=>[],'data'=>null];

        try {
            if(!$token = Auth::refresh())
            {
                $res=['success'=>false,'message'=>'Unauthorized, email or password is wrong','errors'=>[],'data'=>null];
            }
            else{
                Auth::setToken($token);
                $user = Auth::user();
                $user['access_token']=$token;
                $res=['success'=>true,'message'=>'Authentication Successfull','errors'=>[],'data'=>$user];
            }

            return response()->json($res);

            
            } catch (Exception $e) {
                if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException){
                    $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                    return response()->json($res, 403);                
                }

                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

            } catch (Throwable $e){
                
                if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException){
                    $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                    return response()->json($res, 403);                
                }

                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);


            }

    }



    public function logout()
    {   
        try {
            Auth::logout();
            $res=['success'=>true,'message'=>'Successfully logged out','errors'=>[],'data'=>null];
            return response()->json($res);        
            } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

            } catch (Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

            }

    }
    


}
