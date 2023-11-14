<?php

namespace CMS\Banner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title','btn_type','btn_text','btn_url','banner_image',''];
    protected $table='banner';
    
    protected static function newFactory()
    {
        return \CMS\Banner\Database\factories\BannerFactory::new();
    }
}
