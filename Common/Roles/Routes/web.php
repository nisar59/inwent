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

Route::group(['prefix'=>'roles', 'middleware'=>['permission:roles.view']],function() {
    Route::get('/', 'RolesController@index');
});


Route::group(['prefix'=>'roles', 'middleware'=>['permission:roles.create']],function() {
    Route::post('/store', 'RolesController@store');
    Route::get('/permissions/{id}', 'RolesController@permissions');
    Route::post('/permissions/{id}', 'RolesController@permissionsstore');
});

Route::group(['prefix'=>'roles', 'middleware'=>['permission:roles.edit']],function() {
    Route::get('/edit/{id}', 'RolesController@edit');
    Route::POST('/update/{id}', 'RolesController@update');
});

Route::group(['prefix'=>'roles', 'middleware'=>['permission:roles.delete']],function() {
    Route::get('/destroy/{id}', 'RolesController@destroy');
});