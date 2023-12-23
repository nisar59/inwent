<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Common\Wallet\Entities\Wallet;
use Common\Wallet\Entities\WalletTransactions;
use Common\Wallet\Entities\AdminWallet;
use Common\Wallet\Entities\AdminWalletTransactions;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $module=session('module');
        $html='';
        if($module==null){
            $module='inwent';
        }

        if($module=='inwent'){
            $html=view('dashboards.inwent')->render();
        }elseif($module=='wallet'){
            $html=view('dashboards.wallet', ['data'=>$this->wallet()])->render();
        }else{
            $html=view('dashboards.inwent')->render();
        }


        return view('home', compact('html'));
    }


    public function wallet()
    {
       $total=AdminWallet::first();

       return $total;

    }



    
}
