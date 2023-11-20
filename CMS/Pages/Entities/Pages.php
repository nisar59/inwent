<?php

namespace CMS\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\Banner\Entities\Banner;
use CMS\ActionBanner\Entities\ActionBanner;
use CMS\Sliders\Entities\Sliders;
use CMS\Blocks\Entities\Blocks;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = ['slider_banner_type','slider_banner_id','title','slug','meta_title','meta_description'];
    protected $table='cms_pages';
    protected $with=['blocks', 'banner', 'action_banner', 'slider'];
    protected static function newFactory()
    {
        return \CMS\Pages\Database\factories\PagesFactory::new();
    }
    public function blocks()
    {
        return $this->hasMany(Blocks::class, 'page_id', 'id');
    }

    public function banner()
    {
        return $this->hasOne(Banner::class,'id', 'slider_banner_id');
    }

    public function action_banner()
    {
        return $this->hasOne(ActionBanner::class,'id', 'slider_banner_id');
    }

    public function slider()
    {
        return $this->hasOne(Sliders::class,'id', 'slider_banner_id');
    }

}
