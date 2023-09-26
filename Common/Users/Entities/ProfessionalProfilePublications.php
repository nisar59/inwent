<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfilePublications extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','publication_title','publication_abstract','publication_cover_image','publication_link','publication_tags','publication_description','workplace_name','country_id','city_id'];
    protected $table='professional_profile_publications';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfilePublicationsFactory::new();
    }
}
