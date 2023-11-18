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

Route::group(['prefix'=>'project-config', 'middleware'=>['permission:project-config.view']],function() {
    Route::get('/', 'ProjectConfigController@index');
});


Route::group(['prefix'=>'project-config', 'middleware'=>['permission:project-config.create']],function() {
    Route::get('/create', 'ProjectConfigController@create');
    Route::post('/store', 'ProjectConfigController@store');
});

Route::group(['prefix'=>'project-config', 'middleware'=>['permission:project-config.edit']],function() {
    Route::get('/edit/{id}', 'ProjectConfigController@edit');
    Route::POST('/update/{id}', 'ProjectConfigController@update');
    Route::get('/status/{id}', 'ProjectConfigController@status');

});

Route::group(['prefix'=>'project-config', 'middleware'=>['permission:project-config.delete']],function() {
    Route::get('/destroy/{id}', 'ProjectConfigController@destroy');
});

