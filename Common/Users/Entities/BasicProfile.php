<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasicProfile extends Model
{
    use HasFactory;

    protected $table='basic_profiles';
    protected $fillable = ['user_id','title_prefixe','first_name','last_name','address','contact_no','brief_bio','website','profile_tages','interests','social_links','preferred_language','country_id','state_id','city_id','postal_code','job_title'];
    
    protected $appends=['country_name', 'city_name'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function newFactory()
    {
        return \Common\Users\Database\factories\BasicProfileFactory::new();
    }



    public function getIdAttribute($value)
    {
        return InwntEncrypt($value);
    }

    public function getUserIdAttribute($value)
    {
        return InwntEncrypt($value);
    }

    public function getProfileTagesAttribute($value){
        return json_decode($value);
    }

    public function getInterestsAttribute($value){
        return json_decode($value);
    }

    public function getSocialLinksAttribute($value){
        return json_decode($value);
    }

    public function getCityNameAttribute()
    {
       return CityName($this->city_id);
    }

    public function getCountryNameAttribute()
    {
       return CountryName($this->country_id);
    }

}
