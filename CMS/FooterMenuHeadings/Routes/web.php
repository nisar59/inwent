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

Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu-headings.view']],function() {
    Route::get('/', 'FooterMenuHeadingsController@index');
});


Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu-headings.create']],function() {
    Route::get('/create', 'FooterMenuHeadingsController@create');
    Route::post('/store', 'FooterMenuHeadingsController@store');
});

Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu-headings.edit']],function() {
    Route::get('/edit/{id}', 'FooterMenuHeadingsController@edit');
    Route::POST('/update/{id}', 'FooterMenuHeadingsController@update');
 	Route::get('/status/{id}', 'FooterMenuHeadingsController@status');
});
Route::group(['prefix'=>'footer-menu-headings', 'middleware'=>['permission:footer-menu-headings.delete']],function() {
    Route::get('/destroy/{id}', 'FooterMenuHeadingsController@destroy');
});
