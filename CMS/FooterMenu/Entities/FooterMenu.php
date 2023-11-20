<?php

namespace CMS\FooterMenu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\FooterMenu\Entities\FooterMenuHeadings;

class FooterMenu extends Model
{
    use HasFactory;

    protected $fillable = ['cms_footer_menu_heading_id','text','url_type','url','target'];
    protected $table='cms_footer_menu';
    
    protected static function newFactory()
    {
        return \CMS\FooterMenu\Database\factories\FooterMenuFactory::new();
    }
     public function menuheading()
    {
    	return $this->belongsTo(FooterMenuHeadings::class,'cms_footer_menu_heading_id','id');
    }
}
