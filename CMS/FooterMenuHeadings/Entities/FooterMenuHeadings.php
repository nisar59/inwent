<?php

namespace CMS\FooterMenuHeadings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterMenuHeadings extends Model
{
    use HasFactory;

    protected $fillable = ['heading'];
    protected $table='cms_footer_menu_headings';
    
    protected static function newFactory()
    {
        return \CMS\FooterMenuHeadings\Database\factories\FooterMenuHeadingsFactory::new();
    }
}
