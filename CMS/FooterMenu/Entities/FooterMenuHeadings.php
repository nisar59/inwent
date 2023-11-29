<?php

namespace CMS\FooterMenu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\FooterMenu\Entities\FooterMenu;

class FooterMenuHeadings extends Model
{
    use HasFactory;

    protected $table='cms_footer_menu_headings';
    protected $fillable = ['heading'];
    protected $with=['menu'];
    protected static function newFactory()
    {
        return \CMS\FooterMenu\Database\factories\FooterMenuHeadingsFactory::new();
    }

    public function menu(){
       return $this->hasMany(FooterMenu::class, 'cms_footer_menu_heading_id', 'id');
    }
}
