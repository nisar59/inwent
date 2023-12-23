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


Route::group(['prefix'=>'blogs', 'middleware'=>['permission:blogs.view']],function() {
    Route::get('/{id}', 'BlogController@index');
});


Route::group(['prefix'=>'blogs', 'middleware'=>['permission:blogs.create']],function() {
    Route::get('/create/{id}', 'BlogController@create');
    Route::post('/store/{id}', 'BlogController@store');
});

Route::group(['prefix'=>'blogs', 'middleware'=>['permission:blogs.edit']],function() {
    Route::get('/edit/{id}', 'BlogController@edit');
    Route::POST('/update/{id}', 'BlogController@update');
    Route::get('/status/{id}', 'BlogController@status');
});

Route::group(['prefix'=>'blogs', 'middleware'=>['permission:blogs.delete']],function() {
    Route::get('/destroy/{id}', 'BlogController@destroy');
});

