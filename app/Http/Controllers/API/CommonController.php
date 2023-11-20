<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Common\Countries\Entities\Countries;
use Common\States\Entities\States;
use Common\Cities\Entities\Cities;
use CMS\Pages\Entities\Pages;
use Auth;
use DB;
use Throwable;
use Storage;
class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function geo()
    {


        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $countries=Countries::get('id', 'name');       
            $states=States::get('id', 'country_id', 'name');
            $data=[               
                'countries'=>$countries, 
                'states'=>$states,
            ];

            $res=['success'=>true,'message'=>'Geo successfully fetched','errors'=>[],'data'=>$data];
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
    public function cities()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $cities=Cities::get( 'id', 'country_id', 'state_id', 'name');
            $data=[               
                'cities'=>$cities
            ];

            $res=['success'=>true,'message'=>'cities successfully fetched','errors'=>[],'data'=>$data];
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
    public function setup()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $setup=Settings();
            $pages=Pages::all();
            $data=[               
                'setup'=>$setup,
                'pages'=>$pages,
            ];

            $res=['success'=>true,'message'=>'setup successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }








}
