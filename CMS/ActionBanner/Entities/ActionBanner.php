<?php

namespace CMS\ActionBanner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionBanner extends Model
{
    use HasFactory;
    
    protected $table='action_banner';

    protected $fillable = ['title','sub_title','image','description','stats','actions'];
    
    protected static function newFactory()
    {
        return \CMS\ActionBanner\Database\factories\ActionBannerFactory::new();
    }
}
