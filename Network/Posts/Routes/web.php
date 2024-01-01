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

Route::group(['prefix'=>'network/posts', 'middleware'=>['permission:posts.view']],function() {
    Route::get('/', 'PostsController@index');
    Route::get('show/{id}', 'PostsController@show');
});

Route::group(['prefix'=>'network/posts', 'middleware'=>['permission:posts.edit']],function() {
    Route::POST('/update/{id}', 'PostsController@update');
    Route::get('/status/{id}', 'PostsController@status');

});