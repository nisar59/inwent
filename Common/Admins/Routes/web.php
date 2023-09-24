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

Route::group(['prefix'=>'admins', 'middleware'=>['permission:admins.view']],function() {
    Route::get('/', 'AdminsController@index');
});


Route::group(['prefix'=>'admins', 'middleware'=>['permission:admins.create']],function() {
    Route::get('/create', 'AdminsController@create');
    Route::post('/store', 'AdminsController@store');
});

Route::group(['prefix'=>'admins', 'middleware'=>['permission:admins.edit']],function() {
    Route::get('/edit/{id}', 'AdminsController@edit');
    Route::POST('/update/{id}', 'AdminsController@update');
    Route::get('/status/{id}', 'AdminsController@status');
});

Route::group(['prefix'=>'admins', 'middleware'=>['permission:admins.delete']],function() {
    Route::get('/destroy/{id}', 'AdminsController@destroy');
});