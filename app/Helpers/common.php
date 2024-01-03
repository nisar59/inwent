<?php
use Common\Countries\Entities\Countries;
use Common\Settings\Entities\Settings;
use Common\Cities\Entities\Cities;
use Common\Languages\Entities\Languages;
use Network\BoardsCategories\Entities\BoardsCategories;
use App\Models\Notifications;
use App\Models\UserRatings;

function CountryName($id)
{
    $country=Countries::find($id);

    if($country!=null){
        return $country->name;
    }
}

function CityName($id)
{
    $city=Cities::find($id);

    if($city!=null){
        return $city->name;
    }
}

function LanguageName($id)
{
    $lang=Languages::find($id);

    if($lang!=null){
        return $lang->lang;
    }
}



function Types()
{
	
	$types=[
	'type_of_works'=>"Type Of Works",
	'servives'=>"Servives",
	'expert_types'=>"Expert Types",
	'job_types'=>"Job Types",
	'qualifications'=>"Qualifications",
	'industries'=>"Industries",
	'categories'=>"Categories",
	'topic_areas'=>"Topic Areas",
	'activities'=>"Activities",
	'deliverables'=>"Deliverables",
	'skills'=>"Skills",
	'subject_areas'=>"Subject Areas",
	'subject_area_sub_catagories'=>"Subject Area Sub Catagories",
	'certifications'=>"Certifications",
	'lienses_and_permits'=>"Lienses And Permits",
	'experiences'=>'Experiences',
	'project_duration'=>'Project Duration',
	'skill_level'=>'Skill Level'
];
	return $types;
}

function BannerTitleColors()
{
	$colors=[
		'#000'=>'Black',
		'#dfdff680'=>'Silver',
		'#003EAE'=>'Blue',
		'#6B1EBB'=>'Purple',
		'#14A800'=>'Green',
		'#00BEA6'=>'Light Green',
		'#6E6D7A'=>'Grey'
	];

	return $colors;
}

function ButtonTypes()
{
	$Colortypes=[
		'inwt-btn-grey'=>'Grey Button',
		'inwt-btn-blue'=>'Blue Button',
		'inwt-btn-purple'=>'Purple Button',
		'inwt-btn-green'=>'Green Button',
		'inwt-btn-lightgreen'=>'Light Green Button',
		'inwt-btn-silver'=>'Silver Button',
	];
	return $Colortypes;
}

function VerifiedBadges()
{
	$badge=['PROFESSIONAL', 'INWENTOR', 'RESEARCHER'];
	return $badge;
}


function Settings()
{
	return Settings::first();
}

function WebsiteURL()
{
	$url=Settings()->website_url;
	if(str_ends_with($url, '/')){
		$url=rtrim($url, '/');
	}

	return $url;
}

function paypalConfig()
{
	$paypal_mode='sandbox';
	$sett=Settings();

	if($sett->paypal_mode==1 || $sett->paypal_mode=='1'){
		$paypal_mode='live';
	}

	return [
	    'mode'    => $paypal_mode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
	    'sandbox' => [
	        'client_id'         => $sett->paypal_sandbox_client_id,
	        'client_secret'     => $sett->paypal_sandbox_client_secret,
	        'app_id'            => $sett->paypal_sandbox_app_id,
	    ],
	    'live' => [
	        'client_id'         => $sett->paypal_live_client_id,
	        'client_secret'     => $sett->paypal_live_client_secret,
	        'app_id'            => $sett->paypal_live_app_id,
	    ],

	    'payment_action' =>'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
	    'currency'       =>'USD',
	    'notify_url'     =>'', // Change this accordingly for your application.
	    'locale'         =>'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
	    'validate_ssl'   =>true, // Validate SSL when creating api client.
	];
}



function GenerateNotification($notification){
	return Notifications::create($notification);
}


function GetUserNotifications($user_id){
	$data=[];

	$data['notifications']= Notifications::where(['is_read'=>0,'notification_for'=>0, 'user_to'=>$user_id])->get();
	$data['rating_invitations']= UserRatings::where(['status'=>0,'user_to'=>$user_id])->count();

	return $data;
}

function GetAdminNotifications(){
	return Notifications::where(['is_read'=>0,'notification_for'=>0])->get();
}

function BoardsCategories()
{
	return BoardsCategories::where(['status'=>1, 'parent_id'=>null])->get();
}