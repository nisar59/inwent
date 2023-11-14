<?php
use Common\Countries\Entities\Countries;
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
	'type-of-work'=>"Type Of Work",
	'servive'=>"Servive",
	'expert-type'=>"Expert Type",
	'job-type'=>"Job Type",
	'qualification'=>"Qualification",
	'industry'=>"Industry",
	'category'=>"Category",
	'topic-area'=>"Topic Area",
	'activity'=>"Activity",
	'deliverable'=>"Deliverable",
	'skills'=>"Skills",
	'subject-area'=>"Subject Area",
	'subject-area-sub-catagory'=>"Subject Area Sub Catagory",
	'certification'=>"Certification",
	'lienses-and-permit'=>"Lienses And Permit",
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