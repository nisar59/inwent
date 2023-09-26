<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfilePatentDetails extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','patent_title','status','patent_number','patent_abstract','patent_cover_image','patent_link','patent_tags','patent_tag_line','workplace_name','country_id','city_id'];
    protected $table='professional_profile_patent_details';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfilePatentDetailsFactory::new();
    }
}
