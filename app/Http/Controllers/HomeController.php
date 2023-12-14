<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if($module==null){
            $module='inwent';
        }
        
        $html=view('dashboards.inwent')->render();

        return view('home', compact('html'));
    }



    
}
