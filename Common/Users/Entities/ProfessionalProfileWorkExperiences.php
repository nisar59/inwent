<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileWorkExperiences extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','job_title','company_name','company_website','start_date','end_date','work_email','work_type','location','country_id','state_id','city_id','remote_work','primary_role','job_duties','skills','tools','project_description','workplace_name'];

    protected $table='professional_profile_work_experiences';
    protected $appends=['country_name', 'city_name'];
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileWorkExperiencesFactory::new();
    }

    public function getSkillsAttribute($value)
    {
        return json_decode($value);
    }

    public function getToolsAttribute($value)
    {
        return json_decode($value);
    }

    public function getCityNameAttribute()
    {
       return CityName($this->city_id);
    }

    public function getCountryNameAttribute()
    {
       return CountryName($this->country_id);
    }
}
