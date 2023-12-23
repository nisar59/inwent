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

Route::group(['prefix'=>'wallet', 'middleware'=>['permission:wallet.view']],function() {
    Route::get('/', 'WalletController@index');
    Route::get('show/', 'WalletController@show');
});

Route::group(['prefix'=>'wallet/deposits', 'middleware'=>['permission:wallet.deposits']],function() {
    Route::get('/', 'WalletController@deposits');
    Route::get('/{id}/{status}', 'WalletController@status');
});

Route::group(['prefix'=>'wallet', 'middleware'=>['permission:wallet.create']],function() {
    Route::get('/create', 'WalletController@create');
    Route::post('/store', 'WalletController@store');
});

Route::group(['prefix'=>'wallet', 'middleware'=>['permission:wallet.edit']],function() {
    Route::get('/edit/{id}', 'WalletController@edit');
    Route::POST('/update/{id}', 'WalletController@update');
    Route::get('/status/{id}', 'WalletController@status');

});

Route::group(['prefix'=>'wallet', 'middleware'=>['permission:wallet.delete']],function() {
    Route::get('/destroy/{id}', 'WalletController@destroy');
});