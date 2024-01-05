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

// Route::get('/', function () {

//     //$data=DB::select('Show columns From crowd_funding_equity_campaign');
//     $data=DB::select('Show columns From investor_profile');
//     $fileds='';
//     foreach ($data as $key => $value) {
//          if($value->Field!="id" && $value->Field!="created_at" && $value->Field!="updated_at"){
//             $fileds.="'".$value->Field."',";
//          }
//     }
//     dd($fileds);
//     $form='';
//     foreach ($data as $key => $value) {
//        if($value->Field!="id" && $value->Field!="created_at" && $value->Field!="updated_at"){
//         $form.=$value->Field.":"."new FormControl('', Validators.compose([Validators.required])),\n";
//        }
//     }
//     dd($form);
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');



Route::get('module/{slug}',function($slug){
    session(['module'=>$slug]);
    return redirect('/');

});
