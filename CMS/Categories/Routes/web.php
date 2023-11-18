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

Route::group(['prefix'=>'categories', 'middleware'=>['permission:categories.view']],function() {
    Route::get('/', 'CategoriesController@index');
});


Route::group(['prefix'=>'categories', 'middleware'=>['permission:categories.create']],function() {
    Route::get('/create', 'CategoriesController@create');
    Route::post('/store', 'CategoriesController@store');
});

Route::group(['prefix'=>'categories', 'middleware'=>['permission:categories.edit']],function() {
    Route::get('/edit/{id}', 'CategoriesController@edit');
    Route::POST('/update/{id}', 'CategoriesController@update');
    Route::get('/status/{id}', 'CategoriesController@status');
});

Route::group(['prefix'=>'categories', 'middleware'=>['permission:categories.delete']],function() {
    Route::get('/destroy/{id}', 'CategoriesController@destroy');
});