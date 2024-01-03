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

Route::group(['prefix'=>'network/boards', 'middleware'=>['jwt.verify']],function(){
    Route::get('/', 'API\BoardsController@index');
    Route::get('categories/', 'API\BoardsController@categories');
    Route::get('store/', 'API\BoardsController@index');
});