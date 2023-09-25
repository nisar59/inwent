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


Route::group(['prefix'=>'professional-skills', 'middleware'=>['permission:professional-skills.view']],function() {
    Route::get('/', 'ProfessionalSkillsController@index');
});


Route::group(['prefix'=>'professional-skills', 'middleware'=>['permission:professional-skills.create']],function() {
    Route::get('/create', 'ProfessionalSkillsController@create');
    Route::post('/store', 'ProfessionalSkillsController@store');
});

Route::group(['prefix'=>'professional-skills', 'middleware'=>['permission:professional-skills.edit']],function() {
    Route::get('/edit/{id}', 'ProfessionalSkillsController@edit');
    Route::POST('/update/{id}', 'ProfessionalSkillsController@update');
    Route::get('/status/{id}', 'ProfessionalSkillsController@status');
});

Route::group(['prefix'=>'professional-skills', 'middleware'=>['permission:professional-skills.delete']],function() {
    Route::get('/destroy/{id}', 'ProfessionalSkillsController@destroy');
});