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
		'#000000'=>'Black',
		'#6aa84f'=>'Green',
		'#93c47d'=>'Light Green',
		'#073763'=>'Blue',
		'#6e41e1'=>'Purple',
		'#8e7cc3'=>'Light Purple',
	];

	return $colors;
}

function ButtonTypes()
{
	$Colortypes=[
		'btn btn-primary'=>'Primary',
		'btn btn-secondary'=>'Secondary',
		'btn btn-success'=>'Success',
		'btn btn-danger'=>'Danger',
		'btn btn-warning'=>'Warning',
		'btn btn-info'=>'Info',
		'btn btn-light'=>'Light',
		'btn btn-dark'=>'Dark',
		'btn btn-link'=>'Link',
	];
	return $Colortypes;
}

function Settings()
{
	return Settings::first();
}