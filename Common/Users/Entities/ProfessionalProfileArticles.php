<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileArticles extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','article_title','event_organizer','article_abstract','article_cover_image','article_link','article_tags','article_tag_line','workplace_name','country_id','city_id'];
    protected $table='professional_profile_articles';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileArticlesFactory::new();
    }
}
