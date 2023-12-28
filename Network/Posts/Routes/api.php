<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'network', 'middleware'=>['jwt.verify']],function(){
    Route::get('posts/', 'API\PostsController@index');
    Route::post('posts/store', 'API\PostsController@store');
    Route::post('posts/update/{id}', 'API\PostsController@update');
    Route::get('posts/delete/{id}', 'API\PostsController@destroy');
});


Route::group(['prefix'=>'network', 'middleware'=>['jwt.verify']],function(){
    Route::post('posts/comment/store', 'API\PostsController@commentStore');
    Route::post('posts/comment/update/{id}', 'API\PostsController@commentUpdate');
    Route::get('posts/comment/delete/{id}', 'API\PostsController@commentDestroy');
});


Route::group(['prefix'=>'network', 'middleware'=>['jwt.verify']],function(){
    Route::post('posts/reaction/update', 'API\PostsController@reactionUpdated');
});

Route::group(['prefix'=>'network', 'middleware'=>['jwt.verify']],function(){
    Route::post('events/store', 'API\PostsController@eventStore');
});