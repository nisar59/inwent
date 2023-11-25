<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    // $data=DB::select('Show columns From crowd_funding_equity_campaign');
    // $form='';
    // foreach ($data as $key => $value) {
    //    if($value->Field!="id" && $value->Field!="created_at" && $value->Field!="updated_at"){
    //     $form.=$value->Field.":"."new FormControl('', Validators.compose([Validators.required])),\n";
    //    }
    // }
    // dd($form);
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::get('home', 'HomeController@index')->name('home');
