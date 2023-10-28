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
    Route::get('connects/', 'API\ConnectsController@index');
    Route::post('connects/store', 'API\ConnectsController@store');
    Route::post('connects/accept-reject', 'API\ConnectsController@update');
    Route::get('connects/delete/{id}', 'API\ConnectsController@destroy');
    Route::post('search', 'API\ConnectsController@search');
});