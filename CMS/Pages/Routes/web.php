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


Route::group(['prefix'=>'pages', 'middleware'=>['permission:pages.view']],function() {
    Route::get('/', 'PagesController@index');
});


Route::group(['prefix'=>'pages', 'middleware'=>['permission:pages.create']],function() {
    Route::get('/create', 'PagesController@create');
    Route::post('/store', 'PagesController@store');
});

Route::group(['prefix'=>'pages', 'middleware'=>['permission:pages.edit']],function() {
    Route::get('/edit/{id}', 'PagesController@edit');
    Route::POST('/update/{id}', 'PagesController@update');
});

Route::group(['prefix'=>'pages', 'middleware'=>['permission:pages.delete']],function() {
    Route::get('/destroy/{id}', 'PagesController@destroy');
});
