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


Route::group(['prefix'=>'blog-categories', 'middleware'=>['permission:blog-categories.view']],function() {
    Route::get('/', 'BlogCategoriesController@index');
});


Route::group(['prefix'=>'blog-categories', 'middleware'=>['permission:blog-categories.create']],function() {
    Route::post('/store', 'BlogCategoriesController@store');
});

Route::group(['prefix'=>'blog-categories', 'middleware'=>['permission:blog-categories.edit']],function() {
    Route::get('/edit/{id}', 'BlogCategoriesController@edit');
    Route::POST('/update/{id}', 'BlogCategoriesController@update');
    Route::get('/status/{id}', 'BlogCategoriesController@status');
});

Route::group(['prefix'=>'blog-categories', 'middleware'=>['permission:blog-categories.delete']],function() {
    Route::get('/destroy/{id}', 'BlogCategoriesController@destroy');
});