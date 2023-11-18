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


Route::group(['prefix'=>'knowledge-base-categories', 'middleware'=>['permission:knowledge-base-categories.view']],function() {
    Route::get('/', 'KnowledgeBaseCategoriesController@index');
});


Route::group(['prefix'=>'knowledge-base-categories', 'middleware'=>['permission:knowledge-base-categories.create']],function() {
    Route::get('/create', 'KnowledgeBaseCategoriesController@create');
    Route::post('/store', 'KnowledgeBaseCategoriesController@store');
});

Route::group(['prefix'=>'knowledge-base-categories', 'middleware'=>['permission:knowledge-base-categories.edit']],function() {
    Route::get('/edit/{id}', 'KnowledgeBaseCategoriesController@edit');
    Route::POST('/update/{id}', 'KnowledgeBaseCategoriesController@update');
    Route::get('/status/{id}', 'KnowledgeBaseCategoriesController@status');

});

Route::group(['prefix'=>'knowledge-base-categories', 'middleware'=>['permission:knowledge-base-categories.delete']],function() {
    Route::get('/destroy/{id}', 'KnowledgeBaseCategoriesController@destroy');
});
