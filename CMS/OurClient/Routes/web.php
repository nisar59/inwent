<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.view']],function() {
    Route::get('/', 'OurClientController@index');
});


Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.create']],function() {
    Route::get('/create', 'OurClientController@create');
    Route::post('/store', 'OurClientController@store');
});

Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.edit']],function() {
    Route::get('/edit/{id}', 'OurClientController@edit');
    Route::POST('/update/{id}', 'OurClientController@update');
    Route::get('/status/{id}', 'OurClientController@status');

});

Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.delete']],function() {
    Route::get('/destroy/{id}', 'OurClientController@destroy');
});
