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


Route::group(['prefix'=>'network/boards-categories', 'middleware'=>['permission:boards-categories.view']],function() {
    Route::get('/', 'BoardsCategoriesController@index');
});


Route::group(['prefix'=>'network/boards-categories', 'middleware'=>['permission:boards-categories.create']],function() {
    Route::post('/store', 'BoardsCategoriesController@store');
});

Route::group(['prefix'=>'network/boards-categories', 'middleware'=>['permission:boards-categories.edit']],function() {
    Route::get('/edit/{id}', 'BoardsCategoriesController@edit');
    Route::POST('/update/{id}', 'BoardsCategoriesController@update');
    Route::get('/status/{id}', 'BoardsCategoriesController@status');
});

Route::group(['prefix'=>'network/boards-categories', 'middleware'=>['permission:boards-categories.delete']],function() {
    Route::get('/destroy/{id}', 'BoardsCategoriesController@destroy');
});