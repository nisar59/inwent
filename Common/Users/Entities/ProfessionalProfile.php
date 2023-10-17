<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Common\Users\Entities\ProfessionalProfileProjects;

class ProfessionalProfile extends Model
{
    use HasFactory;

    protected $table='professional_profile';
    protected $fillable = ['user_id','profile_status','skills_tags','skills_other_tags','tools_tags','tools_other_tags','regulatory_compliance','agree_to_terms','agree_to_get_offers'];
    
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


}
