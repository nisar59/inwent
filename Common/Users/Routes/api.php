<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'users', 'middleware'=>['jwt.verify']],function()
{
    Route::get('basic-profile', 'API\UsersController@basicProfile');
    Route::post('basic-profile', 'API\UsersController@basicProfileUpdate');
    Route::get('professional-profile', 'API\ProfessionalProfileController@index');
    Route::post('professional-profile', 'API\ProfessionalProfileController@professionalProfileUpdate');
    Route::post('professional-profile-awards/{id}', 'API\ProfessionalProfileController@professionalProfileAwardsUpdate');

});