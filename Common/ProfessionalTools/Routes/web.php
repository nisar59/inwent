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

Route::group(['prefix'=>'professional-tools', 'middleware'=>['permission:professional-tools.view']],function() {
    Route::get('/', 'ProfessionalToolsController@index');
});


Route::group(['prefix'=>'professional-tools', 'middleware'=>['permission:professional-tools.create']],function() {
    Route::get('/create', 'ProfessionalToolsController@create');
    Route::post('/store', 'ProfessionalToolsController@store');
});

Route::group(['prefix'=>'professional-tools', 'middleware'=>['permission:professional-tools.edit']],function() {
    Route::get('/edit/{id}', 'ProfessionalToolsController@edit');
    Route::POST('/update/{id}', 'ProfessionalToolsController@update');
    Route::get('/status/{id}', 'ProfessionalToolsController@status');
});

Route::group(['prefix'=>'professional-tools', 'middleware'=>['permission:professional-tools.delete']],function() {
    Route::get('/destroy/{id}', 'ProfessionalToolsController@destroy');
});
