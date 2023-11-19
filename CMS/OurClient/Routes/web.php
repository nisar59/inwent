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
    Route::get('/', 'OURClientController@index');
});


Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.create']],function() {
    Route::get('/create', 'OURClientController@create');
    Route::post('/store', 'OURClientController@store');
});

Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.edit']],function() {
    Route::get('/edit/{id}', 'OURClientController@edit');
    Route::POST('/update/{id}', 'OURClientController@update');
    Route::get('/status/{id}', 'OURClientController@status');

});

Route::group(['prefix'=>'our-client', 'middleware'=>['permission:our-client.delete']],function() {
    Route::get('/destroy/{id}', 'OURClientController@destroy');
});
