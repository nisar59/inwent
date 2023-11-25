<?php

namespace CrowdFunding\CrowdFundingProjects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrowdFundingProjects extends Model
{
    use HasFactory;

    protected $table='crowd_funding_equity_campaign';
    protected $fillable = ['user_id','company_name','category_id','tagline','brief_bio','reason_to_invest','reason_source_name','reason_source_link','reason_pitch','reason_category','overview_title','overview_description','overview_source','overview_link','overview_media','problem_title','problem_description','problem_source','problem_link','problem_media','solution_title','solution_description','solution_source','solution_link','solution_media','traction_title','traction_description','traction_source','traction_link','traction_media','market_title','market_description','market_source','market_link','market_media','invest_title','invest_description','invest_source','invest_link','invest_media','about_us_company_name','about_us_company_address','about_us_company_valuation','about_us_company_bio','teams','terms_price_per_share','terms_valuation','terms_deadline','terms_amount_raised','breakdown_offer_type','breakdown_asset_type','breakdown_min_invest','breakdown_mx_invest','breakdown_min_share_offered','breakdown_max_share_offered','reg_filing_name','reg_filing_link','circular_name','circular_link','memorandom_name','memorandom_link','risk_name','risk_info','term_company_name','term_company_address','term_company_offering_type','term_company_sec_type','term_company_min_share_offered','term_company_max_share_offered','term_company_money_valuation','term_company_min_offering','term_company_max_offering','term_company_share_price','term_company_min_investment','voting_rights','vr_time_base_bonus','vr_time_base_friends_family','vr_time_base_super_early','vr_time_base_launch_special','vr_time_base_other','vr_amount_base_bonus','vr_amount_base_friends_family','vr_amount_base_super_early','vr_amount_base_launch_special','vr_amount_base_other','vr_registered_plan_users','news_update_date','news_update_title','news_update_subtitle','news_update_launch','news_update_description','reward','rwd_time_base_bonus','rwd_time_base_friends_family','rwd_time_base_super_early','rwd_time_base_launch_special','rwd_time_base_other','rwd_amount_base_bonus','rwd_amount_base_friends_family','rwd_amount_base_super_early','rwd_amount_base_launch_special','rwd_amount_base_other','rwd_registered_plan_users','discussion','vision','vision_subtitle','vision_source','vision_link','vision_media','business_model','business_model_subtitle','business_model_source','business_model_link','business_model_media','what_we_do','wed_subtitle','wed_source','wed_link','wed_media'];
    
    protected static function newFactory()
    {
        return \CrowdFunding\CrowdFundingProjects\Database\factories\CrowdFundingProjectsFactory::new();
    }
}
