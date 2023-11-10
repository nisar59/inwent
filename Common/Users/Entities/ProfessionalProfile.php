<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Common\Users\Entities\ProfessionalProfileAwards;
use Common\Users\Entities\ProfessionalProfileArticles;
use Common\Users\Entities\ProfessionalProfileCareerBreak;
use Common\Users\Entities\ProfessionalProfileCertifications;
use Common\Users\Entities\ProfessionalProfileCourses;
use Common\Users\Entities\ProfessionalProfileEducation;
use Common\Users\Entities\ProfessionalProfileLanguages;
use Common\Users\Entities\ProfessionalProfileVolunteering;
use Common\Users\Entities\ProfessionalProfileWorkExperiences;
use Common\Users\Entities\ProfessionalProfileConferences;
use Common\Users\Entities\ProfessionalProfilePatentDetails;
use Common\Users\Entities\ProfessionalProfileProjects;
use Common\Users\Entities\ProfessionalProfilePublications;
use Common\Users\Entities\ProfessionalProfileCompliance;

class ProfessionalProfile extends Model
{
    use HasFactory;

    protected $table='professional_profile';
    protected $fillable = ['user_id','profile_status','skills_tags','skills_other_tags','tools_tags','tools_other_tags','agree_to_terms','agree_to_get_offers'];
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileFactory::new();
    }


    public function getSkillsTagsAttribute($value)
    {
        return json_decode($value);
    }

    public function getSkillsOtherTagsAttribute($value)
    {
        return json_decode($value);
    }

    public function getToolsTagsAttribute($value)
    {
        return json_decode($value);
    }


    public function getToolsOtherTagsAttribute($value)
    {
        return json_decode($value);
    }


    public function projects()
    {
       return $this->hasMany(ProfessionalProfileProjects::class,'professional_profile_id', 'id');
    }

    public function publications()
    {
       return $this->hasMany(ProfessionalProfilePublications::class,'professional_profile_id', 'id');
    }

    public function patents()
    {
       return $this->hasMany(ProfessionalProfilePatentDetails::class,'professional_profile_id', 'id');
    }

    public function conferences()
    {
       return $this->hasMany(ProfessionalProfileConferences::class,'professional_profile_id', 'id');
    }

    public function articles()
    {
       return $this->hasMany(ProfessionalProfileArticles::class,'professional_profile_id', 'id');
    }

    public function experience()
    {
       return $this->hasMany(ProfessionalProfileWorkExperiences::class,'professional_profile_id', 'id');
    }

    public function education()
    {
       return $this->hasMany(ProfessionalProfileEducation::class,'professional_profile_id', 'id');
    }

    public function courses()
    {
       return $this->hasMany(ProfessionalProfileCourses::class,'professional_profile_id', 'id');
    }

    public function certificates()
    {
       return $this->hasMany(ProfessionalProfileCertifications::class,'professional_profile_id', 'id');
    }

    public function volunteerings()
    {
       return $this->hasMany(ProfessionalProfileVolunteering::class,'professional_profile_id', 'id');
    }

    public function awards()
    {
       return $this->hasMany(ProfessionalProfileAwards::class,'professional_profile_id', 'id');
    }

    public function languages()
    {
       return $this->hasMany(ProfessionalProfileLanguages::class,'professional_profile_id', 'id');
    }

    public function breaks()
    {
       return $this->hasMany(ProfessionalProfileCareerBreak::class,'professional_profile_id', 'id');
    }

    public function compliances()
    {
       return $this->hasMany(ProfessionalProfileCompliance::class,'professional_profile_id', 'id');
    }


}
