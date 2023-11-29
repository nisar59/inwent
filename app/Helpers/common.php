<?php
use Common\Countries\Entities\Countries;
use Common\Settings\Entities\Settings;
use Common\Cities\Entities\Cities;


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