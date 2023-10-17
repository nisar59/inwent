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

Route::group(['prefix'=>'draft', 'middleware'=>['jwt.verify']],function()
{
    Route::post('get', 'API\DraftController@index');
    Route::post('store', 'API\DraftController@store');
});