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


Route::group(['prefix'=>'blocks', 'middleware'=>['permission:blocks.view']],function() {
    Route::get('/{id}', 'BlocksController@index');
});


Route::group(['prefix'=>'blocks', 'middleware'=>['permission:blocks.create']],function() {
    Route::post('/create/{id}/{key}', 'BlocksController@create');
    Route::post('/store/{id}/{key}', 'BlocksController@store');
});

Route::group(['prefix'=>'blocks', 'middleware'=>['permission:blocks.edit']],function() {
    Route::get('/edit/{id}', 'BlocksController@edit');
    Route::POST('/update/{id}', 'BlocksController@update');
});

Route::group(['prefix'=>'blocks', 'middleware'=>['permission:blocks.delete']],function() {
    Route::get('/destroy/{id}', 'BlocksController@destroy');
});