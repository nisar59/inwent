<?php

namespace CMS\FooterMenu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterMenuHeadings extends Model
{
    use HasFactory;

    protected $table='cms_footer_menu_headings';
    protected $fillable = ['heading'];
    
    protected static function newFactory()
    {
        return \CMS\FooterMenu\Database\factories\FooterMenuHeadingsFactory::new();
    }
}
