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


Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu.view']],function() {
    Route::get('/', 'FooterMenuController@headingIndex');
});


Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu.create']],function() {
    Route::get('/create', 'FooterMenuController@headingCreate');
    Route::post('/store', 'FooterMenuController@headingStore');
});

Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu.edit']],function() {
    Route::get('/edit/{id}', 'FooterMenuController@headingEdit');
    Route::POST('/update/{id}', 'FooterMenuController@headingUpdate');
    Route::get('/status/{id}', 'FooterMenuController@headingStatus');
});
Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu.delete']],function() {
    Route::get('/destroy/{id}', 'FooterMenuController@headingDestroy');
});





/*///////////////////////////////////////////////////// Menu ///////////////////////////////////////////*/



Route::group(['prefix'=>'footer-menu', 'middleware'=>['permission:footer-menu.view']],function() {
    Route::get('/{id}', 'FooterMenuController@index');
});


Route::group(['prefix'=>'footer-menu', 'middleware'=>['permission:footer-menu.create']],function() {
    Route::get('/create/{id}', 'FooterMenuController@create');
    Route::post('/store', 'FooterMenuController@store');
});

Route::group(['prefix'=>'footer-menu', 'middleware'=>['permission:footer-menu.edit']],function() {
    Route::get('/edit/{id}', 'FooterMenuController@edit');
    Route::POST('/update/{id}', 'FooterMenuController@update');
});

Route::group(['prefix'=>'footer-menu', 'middleware'=>['permission:footer-menu.delete']],function() {
    Route::get('/destroy/{id}', 'FooterMenuController@destroy');
});