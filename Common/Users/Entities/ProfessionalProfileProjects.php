<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileProjects extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','project_title','project_tage_line','project_cover_image','project_link','project_tags','project_description','workplace_name','country_id','city_id'];
    protected $table='professional_profile_projects';
    protected $appends=['country_name', 'city_name'];
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileProjectsFactory::new();
    }


    public function getProjectCoverImageAttribute($value)
    {
        return $value;
       return StorageFile($value);
    }

    public function getCountryNameAttribute()
    {
        return CountryName($this->country_id);
    }

    public function getCityNameAttribute()
    {
        return CityName($this->city_id);
    }

}
