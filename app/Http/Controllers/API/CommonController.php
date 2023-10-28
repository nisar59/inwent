<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Common\Countries\Entities\Countries;
use Common\States\Entities\States;
use Common\Cities\Entities\Cities;
use Auth;
use DB;
use Throwable;

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
            $countries=Countries::all();       
            $cities=Cities::all();
            $states=States::all();
            $data=[               
                'countries'=>$countries, 
                'states'=>$states,
                'cities'=>$cities,
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
}
