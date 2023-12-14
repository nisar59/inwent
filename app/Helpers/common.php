<?php
use Common\Countries\Entities\Countries;
use Common\Settings\Entities\Settings;
use Common\Cities\Entities\Cities;
use Common\Languages\Entities\Languages;


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



function APPS()
{
	$apps=[
		'inwent'=>[

				'title'=>'Inwent',
				'icon'=>'fas fa-home',
				'bg'=>'#7400B8',
				'permissions'=>[],
				'menu'=>[
					['title'=>'Roles & Permissions','icon'=>'fas fa-user-shield','url'=>'roles', 'prefix'=>'/roles', 'permissions'=>''],
					['title'=>'Admins','icon'=>'fas fa-id-card','url'=>'admins','prefix'=>'/admins', 'permissions'=>''],
					['title'=>'Users','icon'=>'fas fa-users','url'=>'users','prefix'=>'/users', 'permissions'=>''],
				],
		],



		'settings'=>[
				'title'=>'Settings',
				'icon'=>'fas fa-cog',
				'bg'=>'#5E60CE',
				'permissions'=>[],
				'menu'=>[
					['title'=>'General Settings', 'icon'=>'fas fa-cog', 'url'=>'settings','prefix'=>'/settings'],
					['title'=>'Payments Settings', 'icon'=>'fab fa-paypal', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
					['title'=>'Email Settings', 'icon'=>'fas fa-envelope', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
					['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
					['title'=>'Social Links', 'icon'=>'fas fa-share-alt', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
				]
		],



		'cms'=>[
				'title'=>'CMS',
				'icon'=>'fas fa-th-large',
				'bg'=>'#5390D9',
				'permissions'=>[],
				'menu'=>[
					['title'=>'Pages', 'icon'=>'fab fa-elementor', 'url'=>'pages', 'prefix'=>'/pages', 'permissions'=>''],

					['title'=>'Main Menu', 'icon'=>'fas fa-bars', 'url'=>'main-menu', 'prefix'=>'/main-menu', 'permissions'=>''],

					['title'=>'Footer Menu', 'icon'=>'fas fa-chevron-circle-down', 'url'=>'footer-menu-headings', 'prefix'=>'/footer-menu-headings', 'permissions'=>''],

					['title'=>'Sliders', 'icon'=>'fas fa-sliders-h', 'url'=>'sliders', 'prefix'=>'/sliders', 'permissions'=>''],

					['title'=>'Banners', 'icon'=>'fas fa-ticket-alt', 'url'=>'banner', 'prefix'=>'/banner', 'permissions'=>''],

					['title'=>'Action Banners', 'icon'=>'fas fa-money-check', 'url'=>'action-banner', 'prefix'=>'/action-banner', 'permissions'=>''],

					['title'=>'Our Clients', 'icon'=>'fas fa-restroom', 'url'=>'our-client', 'prefix'=>'/our-client', 'permissions'=>''],

					['title'=>'Categories', 'icon'=>'fas fa-database', 'url'=>'categories', 'prefix'=>'/categories', 'permissions'=>''],

					['title'=>'User Reviews', 'icon'=>'fas fa-pen-alt', 'url'=>'user-reviews', 'prefix'=>'/user-reviews', 'permissions'=>''],

					['title'=>'Inwent Legal', 'icon'=>'fas fa-bible', 'url'=>'inwent-legal', 'prefix'=>'/inwent-legal', 'permissions'=>''],

					['title'=>'Blogs', 'icon'=>'fas fa-newspaper', 'url'=>'blog', 'prefix'=>'/blog', 'permissions'=>''],

					['title'=>'Knowledge Base Categories', 'icon'=>'fas fa-list', 'url'=>'knowledge-base-categories', 'prefix'=>'/knowledge-base-categories', 'permissions'=>''],

					['title'=>'Knowledge Base', 'icon'=>'fas fa-book-open', 'url'=>'knowledge-base', 'prefix'=>'/knowledge-base', 'permissions'=>''],
				]
		],



		'network'=>[
				'title'=>'Network',
				'icon'=>'fas fa-bezier-curve',
				'bg'=>'#4EA8DE',
				'permissions'=>[],
				'menu'=>[
					['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
				]
		],




		'freelancing'=>[
				'title'=>'Freelancing',
				'icon'=>'fas fa-chalkboard-teacher',
				'bg'=>'#48BFE3',
				'permissions'=>[],
				'menu'=>[
					['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
				]
		],





		'crowd_funding'=>[
				'title'=>'Crowd Funding',
				'icon'=>'fas fa-hand-holding-usd',
				'bg'=>'#56CFE1',
				'permissions'=>[],
				'menu'=>[
					['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
					['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
				]
		],




		'wallet'=>[
				'title'=>'Wallet',
				'icon'=>'fas fa-wallet',
				'bg'=>'#80FFDB',
				'menu'=>[
					['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>''],
					['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>''],
					['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>''],
					['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>''],
					['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>''],
				]
		],


	];


	return $apps;
}