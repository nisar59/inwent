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

Route::group(['prefix'=>'crowd-funding/reward-projects', 'middleware'=>['permission:projects.view']],function() {
    Route::get('/', 'CrowdFundingProjectsController@index');
    Route::get('show/{id}', 'CrowdFundingProjectsController@show');
});

Route::group(['prefix'=>'crowd-funding/reward-projects', 'middleware'=>['permission:projects.edit']],function() {
    Route::get('/destroy/{id}', 'CrowdFundingProjectsController@destroy');
    Route::get('/status/{id}', 'CrowdFundingProjectsController@status');

});




Route::group(['prefix'=>'crowd-funding/equity-projects', 'middleware'=>['permission:projects.view']],function() {
    Route::get('/', 'CrowdFundingProjectsController@index');
    Route::get('/destroy/{id}', 'CrowdFundingProjectsController@destroy');
    Route::get('/status/{id}', 'CrowdFundingProjectsController@status');
});
