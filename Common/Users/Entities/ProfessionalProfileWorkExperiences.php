<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileWorkExperiences extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','job_title','company_name','company_website','start_date','end_date','work_email','work_type','country_id','state_id','city_id','primary_role','job_duties','project_description','workplace_name','remote_work','skills','tools'];
    protected $table='professional_profile_work_experiences';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileWorkExperiencesFactory::new();
    }
}
