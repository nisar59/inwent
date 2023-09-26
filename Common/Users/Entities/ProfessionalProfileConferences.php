<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileConferences extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','professional_profile_id','presentation_title','status','event_organizer','presentation_abstract','presentation_cover_image','presentation_link','presentation_tags','presentation_tag_line','workplace_name','country_id','city_id'];
    protected $table='professional_profile_conferences';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileConferencesFactory::new();
    }
}
