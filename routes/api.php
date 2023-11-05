<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'auth', 'middleware'=>'api'],function()
{
   Route::post('register', 'API\AuthController@register');
   Route::get('email/verify/{id}', 'API\AuthController@verify')->name('verification.verify');
   Route::get('email/resend/{id}', 'API\AuthController@resend')->name('verification.resend');
   Route::post('login', 'API\AuthController@login');
   Route::get('refresh', 'API\AuthController@refresh');
});


Route::group(['prefix'=>'setup', 'middleware'=>'api'],function()
{
  Route::get('geo', 'API\CommonController@geo');
  Route::get('cities', 'API\CommonController@cities');
});

