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

Route::group(['prefix'=>'messages', 'middleware'=>['jwt.verify']],function(){
    Route::get('threads/{id}', 'API\MessagesController@index');
    Route::get('{id}', 'API\MessagesController@messages');
    Route::post('create-thread/', 'API\MessagesController@createThread');
    Route::post('send-message/', 'API\MessagesController@storeMessage');
    Route::post('update-fcm/', 'API\MessagesController@updateFcm');
});