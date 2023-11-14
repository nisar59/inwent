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

Route::group(['prefix'=>'user-reviews', 'middleware'=>['permission:user-reviews.view']],function() {
    Route::get('/', 'UserReviewsController@index');
});


Route::group(['prefix'=>'user-reviews', 'middleware'=>['permission:user-reviews.create']],function() {
    Route::get('/create', 'UserReviewsController@create');
    Route::post('/store', 'UserReviewsController@store');
});

Route::group(['prefix'=>'user-reviews', 'middleware'=>['permission:user-reviews.edit']],function() {
    Route::get('/edit/{id}', 'UserReviewsController@edit');
    Route::POST('/update/{id}', 'UserReviewsController@update');
    Route::get('/status/{id}', 'UserReviewsController@status');
});

Route::group(['prefix'=>'user-reviews', 'middleware'=>['permission:user-reviews.delete']],function() {
    Route::get('/destroy/{id}', 'UserReviewsController@destroy');
});