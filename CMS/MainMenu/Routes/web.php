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

Route::group(['prefix'=>'main-menu', 'middleware'=>['permission:main-menu.view']],function() {
    Route::get('/', 'MainMenuController@index');
});


Route::group(['prefix'=>'main-menu', 'middleware'=>['permission:main-menu.create']],function() {
    Route::get('/create', 'MainMenuController@create');
    Route::post('/store', 'MainMenuController@store');
});

Route::group(['prefix'=>'main-menu', 'middleware'=>['permission:main-menu.edit']],function() {
    Route::get('/edit/{id}', 'MainMenuController@edit');
    Route::POST('/update/{id}', 'MainMenuController@update');
});

Route::group(['prefix'=>'main-menu', 'middleware'=>['permission:main-menu.delete']],function() {
    Route::get('/destroy/{id}', 'MainMenuController@destroy');
});