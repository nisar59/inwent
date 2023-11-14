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

Route::group(['prefix'=>'action-banner', 'middleware'=>['permission:action-banner.view']],function() {
    Route::get('/', 'ActionBannerController@index');
});


Route::group(['prefix'=>'action-banner', 'middleware'=>['permission:action-banner.create']],function() {
    Route::get('/create', 'ActionBannerController@create');
    Route::post('/store', 'ActionBannerController@store');
});

Route::group(['prefix'=>'action-banner', 'middleware'=>['permission:action-banner.edit']],function() {
    Route::get('/edit/{id}', 'ActionBannerController@edit');
    Route::POST('/update/{id}', 'ActionBannerController@update');
    Route::get('/status/{id}', 'ActionBannerController@status');

});

Route::group(['prefix'=>'action-banner', 'middleware'=>['permission:action-banner.delete']],function() {
    Route::get('/destroy/{id}', 'ActionBannerController@destroy');
});
