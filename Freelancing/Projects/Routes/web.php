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



Route::group(['prefix'=>'freelancing/projects', 'middleware'=>['permission:projects.view']],function() {
    Route::get('/', 'ProjectsController@index');
    Route::get('show/{id}', 'ProjectsController@show');
});

Route::group(['prefix'=>'freelancing/projects', 'middleware'=>['permission:projects.edit']],function() {
    Route::get('/destroy/{id}', 'ProjectsController@destroy');
    Route::get('/status/{id}', 'ProjectsController@status');

});




Route::group(['prefix'=>'freelancing/projects/compeleted', 'middleware'=>['permission:projects.view']],function() {
    Route::get('/', 'ProjectsController@index');
});


Route::group(['prefix'=>'freelancing/projects/on-going', 'middleware'=>['permission:projects.view']],function() {
    Route::get('/', 'ProjectsController@index');
});
