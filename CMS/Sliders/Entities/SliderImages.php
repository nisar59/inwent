<?php

namespace CMS\Sliders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderImages extends Model
{
    use HasFactory;

    protected $fillable = ['slider_id','image'];
    protected $table='slider_images';
    
    protected static function newFactory()
    {
        return \CMS\Sliders\Database\factories\SliderImagesFactory::new();
    }
}
