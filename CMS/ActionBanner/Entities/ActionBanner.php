<?php

namespace CMS\ActionBanner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionBanner extends Model
{
    use HasFactory;

    protected $fillable = ['title','sub_title','image','description','text','text_actions','stats','stats_actions'];
    protected $table='action_banner';
    
    protected static function newFactory()
    {
        return \CMS\ActionBanner\Database\factories\ActionBannerFactory::new();
    }
}
