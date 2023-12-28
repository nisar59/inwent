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


Route::group(['prefix'=>'users', 'middleware'=>['permission:users.view']],function() {
    Route::get('/', 'UsersController@index');
    Route::get('show/{id}', 'UsersController@show');
});

Route::group(['prefix'=>'users', 'middleware'=>['permission:users.edit']],function() {
    Route::POST('/update/{id}', 'UsersController@update');
    Route::get('/status/{id}', 'UsersController@status');

});

