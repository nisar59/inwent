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

Route::group(['prefix'=>'inwent-legal', 'middleware'=>['permission:inwent-legal.view']],function() {
    Route::get('/', 'InwentLegalController@index');
});


Route::group(['prefix'=>'inwent-legal', 'middleware'=>['permission:inwent-legal.create']],function() {
    Route::get('/create', 'InwentLegalController@create');
    Route::post('/store', 'InwentLegalController@store');
});

Route::group(['prefix'=>'inwent-legal', 'middleware'=>['permission:inwent-legal.edit']],function() {
    Route::get('/edit/{id}', 'InwentLegalController@edit');
    Route::POST('/update/{id}', 'InwentLegalController@update');
});

Route::group(['prefix'=>'inwent-legal', 'middleware'=>['permission:inwent-legal.delete']],function() {
    Route::get('/destroy/{id}', 'InwentLegalController@destroy');
});
