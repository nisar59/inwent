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