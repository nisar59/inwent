<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessProfile extends Model
{
    use HasFactory;

    protected $table='business_profile';
    protected $fillable = ['user_id', 'verification_confirmation', 'business_logo', 'business_name','registration_no','founded_year','company_status','get_verified_badge','address','country_id','state_id','city_id','postal_code','contact_no','email','parent_company','website','social_links','bio','profile_tags','company_tag_line','agree_to_terms','agree_to_get_offers'];
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\BusinessProfileFactory::new();
    }
}
