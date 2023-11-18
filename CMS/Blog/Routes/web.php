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


Route::group(['prefix'=>'blog', 'middleware'=>['permission:blog.view']],function() {
    Route::get('/', 'BlogController@index');
});


Route::group(['prefix'=>'blog', 'middleware'=>['permission:blog.create']],function() {
    Route::get('/create', 'BlogController@create');
    Route::post('/store', 'BlogController@store');
});

Route::group(['prefix'=>'blog', 'middleware'=>['permission:blog.edit']],function() {
    Route::get('/edit/{id}', 'BlogController@edit');
    Route::POST('/update/{id}', 'BlogController@update');
    Route::get('/status/{id}', 'BlogController@status');
});

Route::group(['prefix'=>'blog', 'middleware'=>['permission:blog.delete']],function() {
    Route::get('/destroy/{id}', 'BlogController@destroy');
});

