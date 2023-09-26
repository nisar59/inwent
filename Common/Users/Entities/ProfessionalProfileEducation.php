<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileEducation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','institute_name','others','degree_cert_diploma_title','degree_cert_diploma_type','field_of_study','start_date','end_date','currently_enrolled','workplace_name','country_id','state_id','city_id'];
    protected $table='professional_profile_education';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileEducationFactory::new();
    }
}
