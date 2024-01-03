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

Route::group(['prefix'=>'network/boards', 'middleware'=>['permission:boards.view']],function() {
    Route::get('/', 'BoardsController@index');
});


Route::group(['prefix'=>'network/boards', 'middleware'=>['permission:boards.create']],function() {
    Route::post('/store', 'BoardsController@store');
});

Route::group(['prefix'=>'network/boards', 'middleware'=>['permission:boards.edit']],function() {
    Route::get('/edit/{id}', 'BoardsController@edit');
    Route::POST('/update/{id}', 'BoardsController@update');
    Route::get('/status/{id}', 'BoardsController@status');
});

Route::group(['prefix'=>'network/boards', 'middleware'=>['permission:boards.delete']],function() {
    Route::get('/destroy/{id}', 'BoardsController@destroy');
});