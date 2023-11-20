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

 
Route::group(['prefix'=>'sliders', 'middleware'=>['permission:sliders.view']],function() {
    Route::get('/', 'SlidersController@index');
});


Route::group(['prefix'=>'sliders', 'middleware'=>['permission:sliders.create']],function() {
    Route::get('/create', 'SlidersController@create');
    Route::post('/store', 'SlidersController@store');
});

Route::group(['prefix'=>'sliders', 'middleware'=>['permission:sliders.edit']],function() {
    Route::get('/edit/{id}', 'SlidersController@edit');
    Route::POST('/update/{id}', 'SlidersController@update');
});

Route::group(['prefix'=>'sliders', 'middleware'=>['permission:sliders.delete']],function() {
    Route::get('/destroy/{id}', 'SlidersController@destroy');
});

/*/////////////////////////////// Images ///////////////////////////////////////////////////////////*/

Route::group(['prefix'=>'sliders/images', 'middleware'=>['permission:sliders.view']],function() {
    Route::get('/{id}', 'SlidersController@sliderImages');
});


Route::group(['prefix'=>'sliders/images', 'middleware'=>['permission:sliders.create']],function() {
    Route::get('/create/{id}', 'SlidersController@sliderImagesCreate');
    Route::post('/store', 'SlidersController@sliderImagesStore');
});

Route::group(['prefix'=>'sliders/images', 'middleware'=>['permission:sliders.delete']],function() {
    Route::get('/destroy/{id}', 'SlidersController@sliderImagesDestroy');
});