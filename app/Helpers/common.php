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
	'insdustry'=>"Insdustry",
	'catagory'=>"Catagory",
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