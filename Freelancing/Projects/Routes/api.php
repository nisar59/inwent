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

Route::group(['prefix'=>'freelancing/projects', 'middleware'=>['jwt.verify']],function(){
    Route::get('/', 'API\ProjectsController@index');
    Route::get('create', 'API\ProjectsController@create');
    Route::post('store', 'API\ProjectsController@store');
    Route::get('{id}', 'API\ProjectsController@show');
    Route::post('search', 'API\ProjectsController@search');
    Route::post('proposal', 'API\ProjectsController@proposalStore');
    Route::post('create-milestone', 'API\ProjectsController@createMilestone');

});