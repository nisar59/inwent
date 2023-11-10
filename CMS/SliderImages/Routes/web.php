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

Route::group(['prefix'=>'slider-images', 'middleware'=>['permission:slider-images.view']],function() {
    Route::get('/', 'SliderImagesController@index');
});


Route::group(['prefix'=>'slider-images', 'middleware'=>['permission:slider-images.create']],function() {
    Route::get('/create/{id}', 'SliderImagesController@create');
    Route::post('/store', 'SliderImagesController@store');
});

Route::group(['prefix'=>'slider-images', 'middleware'=>['permission:slider-images.edit']],function() {
    Route::get('/edit/{id}', 'SliderImagesController@edit');
    Route::POST('/update/{id}', 'SliderImagesController@update');
});

Route::group(['prefix'=>'slider-images', 'middleware'=>['permission:slider-images.delete']],function() {
    Route::get('/destroy/{id}', 'SliderImagesController@destroy');
});