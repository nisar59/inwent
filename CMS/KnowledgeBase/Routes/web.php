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


Route::group(['prefix'=>'knowledge-base', 'middleware'=>['permission:knowledge-base.view']],function() {
    Route::get('/', 'KnowledgeBaseController@index');
});


Route::group(['prefix'=>'knowledge-base', 'middleware'=>['permission:knowledge-base.create']],function() {
    Route::get('/create', 'KnowledgeBaseController@create');
    Route::post('/store', 'KnowledgeBaseController@store');
});

Route::group(['prefix'=>'knowledge-base', 'middleware'=>['permission:knowledge-base.edit']],function() {
    Route::get('/edit/{id}', 'KnowledgeBaseController@edit');
    Route::get('/status/{id}', 'KnowledgeBaseController@status');
    Route::POST('/update/{id}', 'KnowledgeBaseController@update');
});

Route::group(['prefix'=>'knowledge-base', 'middleware'=>['permission:knowledge-base.delete']],function() {
    Route::get('/destroy/{id}', 'KnowledgeBaseController@destroy');
});
