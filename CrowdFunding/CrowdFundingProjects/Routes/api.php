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

Route::group(['prefix'=>'crowd-funding/projects', 'middleware'=>['jwt.verify']],function(){
    Route::get('/', 'API\CrowdFundingProjectsController@index');
    Route::get('create', 'API\CrowdFundingProjectsController@create');
    Route::post('store', 'API\CrowdFundingProjectsController@store');
    Route::get('{id}', 'API\CrowdFundingProjectsController@show');
    Route::post('search', 'API\CrowdFundingProjectsController@search');

});