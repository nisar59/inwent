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

Route::group(['prefix'=>'users', 'middleware'=>['jwt.verify']],function(){
    Route::get('basic-profile', 'API\UsersController@basicProfile');
    Route::get('basic-profile/{slug}', 'API\UsersController@basicProfileBySlug');
    Route::post('basic-profile', 'API\UsersController@basicProfileUpdate');
    Route::post('image-update', 'API\UsersController@UserImageUpdate');
    
    Route::get('professional-profile', 'API\ProfessionalProfileController@professionalProfile');

    Route::post('professional-profile', 'API\ProfessionalProfileController@professionalProfileUpdate');

    Route::post('professional-profile-awards/', 'API\ProfessionalProfileController@professionalProfileAwardsUpdate');

    Route::post('professional-profile-articles/', 'API\ProfessionalProfileController@professionalProfileArticlesUpdate');

    Route::post('professional-profile-career-break/', 'API\ProfessionalProfileController@professionalProfileCareerBreakUpdate');

    Route::post('professional-profile-certifications/', 'API\ProfessionalProfileController@professionalProfileCertificationsUpdate');

    Route::post('professional-profile-courses/', 'API\ProfessionalProfileController@professionalProfileCoursesUpdate');
    
    Route::post('professional-profile-education/', 'API\ProfessionalProfileController@professionalProfileEducationUpdate');

    Route::post('professional-profile-languages/', 'API\ProfessionalProfileController@professionalProfileLanguagesUpdate');

    Route::post('professional-profile-volunteering/', 'API\ProfessionalProfileController@professionalProfileVolunteeringUpdate');

    Route::post('professional-profile-work-experiences/', 'API\ProfessionalProfileController@professionalProfileWorkExperiencesUpdate');

    Route::post('professional-profile-conferences', 'API\ProfessionalProfileController@professionalProfileConferencesUpdate');

    Route::post('professional-profile-patent-details', 'API\ProfessionalProfileController@professionalProfilePatentDetailsUpdate');

    Route::post('professional-profile-projects', 'API\ProfessionalProfileController@professionalProfileProjectsUpdate');

    Route::post('professional-profile-publications', 'API\ProfessionalProfileController@professionalProfilePublicationsUpdate');


});