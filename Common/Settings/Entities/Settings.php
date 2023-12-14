<?php

namespace Common\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Storage;
class Settings extends Model
{
    use HasFactory;
    protected $table='settings';
    protected $fillable = ['website_url','website_name','portal_name','website_logo','website_logo_small','website_favicon','website_footer_logo','website_auth_logo','portal_logo','portal_logo_small','portal_favicon', 'paypal_mode','paypal_sandbox_client_id','paypal_sandbox_client_secret','paypal_sandbox_app_id','paypal_live_client_id','paypal_live_client_secret','paypal_live_app_id'];


    public function getWebsiteLogoAttribute()
    {
        if($this->attributes['website_logo']!=null){
            return StorageFile($this->attributes['website_logo']);
        }
    }

    public function getWebsiteLogoSmallAttribute()
    {
        if($this->attributes['website_logo_small']!=null){
            return StorageFile($this->attributes['website_logo_small']);
        }
    }

    public function getWebsiteFaviconAttribute()
    {
        if($this->attributes['website_favicon']!=null){
            return StorageFile($this->attributes['website_favicon']);
        }
    }

    public function getWebsiteFooterLogoAttribute()
    {
        if($this->attributes['website_footer_logo']!=null){
            return StorageFile($this->attributes['website_footer_logo']);
        }
    }

    public function getWebsiteAuthLogoAttribute()
    {
        if($this->attributes['website_auth_logo']!=null){
            return StorageFile($this->attributes['website_auth_logo']);
        }
    }

    public function getPortalLogoAttribute()
    {
        if($this->attributes['portal_logo']!=null){
            return StorageFile($this->attributes['portal_logo']);
        }
    }

    public function getPortalLogoSmallAttribute()
    {
        if($this->attributes['portal_logo_small']!=null){
            return StorageFile($this->attributes['portal_logo_small']);
        }
    }

    public function getPortalFaviconAttribute()
    {
        if($this->attributes['portal_favicon']!=null){
            return StorageFile($this->attributes['portal_favicon']);
        }
    }


    protected static function newFactory()
    {
        return \Common\Settings\Database\factories\SettingsFactory::new();
    }
}
