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

Route::group(['prefix'=>'wallet', 'middleware'=>['jwt.verify']],function(){
    Route::get('/', 'API\WalletController@index');
    Route::post('/deposit-request', 'API\WalletController@depositRequest');
    Route::post('/deposit-success', 'API\WalletController@depositSuccess');

});