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

Route::group(['prefix'=>'network/sponsored-posts', 'middleware'=>['permission:sponsored-posts.view']],function() {
    Route::get('/', 'SponsoredPostsController@index');
    Route::get('show/{id}', 'SponsoredPostsController@show');
});


Route::group(['prefix'=>'network/sponsored-posts', 'middleware'=>['permission:sponsored-posts.create']],function() {
    Route::get('/create', 'SponsoredPostsController@create');
    Route::post('/store', 'SponsoredPostsController@store');
});

Route::group(['prefix'=>'network/sponsored-posts', 'middleware'=>['permission:sponsored-posts.edit']],function() {
    Route::get('/edit/{id}', 'SponsoredPostsController@edit');
    Route::POST('/update/{id}', 'SponsoredPostsController@update');
    Route::get('/status/{id}', 'SponsoredPostsController@status');

});

Route::group(['prefix'=>'network/sponsored-posts', 'middleware'=>['permission:sponsored-posts.delete']],function() {
    Route::get('/destroy/{id}', 'SponsoredPostsController@destroy');
});