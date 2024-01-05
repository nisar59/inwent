<?php

namespace CMS\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvestorProfile extends Model
{
    use HasFactory;

    protected $table='investor_profile';
    
    protected $fillable = ['user_id','brief_bio','type_of_company','website','profile_tags','preferred_language','social_links','experties','accomplishments','industry_tags','industry_sub_tags','investor_type','investment_portfolio','offered_investments','investment_region','investment_experience','individual_business','representing_business','dob','gender','first_name','last_name','email','mailing_address','country_id','state_id','city_id','postal_code','phone_no','living_duration','primary_investment_objective','risk_return_concept','investment_knowledge','spouse_an_insider','risk_tolerance','current_employment','registered_individual','trusted_contact','politically_exposed_person','agree_to_terms','agree_to_get_offers'];
    
    protected static function newFactory()
    {
        return \CMS\Users\Database\factories\InvestorProfileFactory::new();
    }
}
