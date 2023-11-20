<?php

namespace CMS\Sliders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\Sliders\Entities\SliderImages;
class Sliders extends Model
{
    use HasFactory;

    protected $fillable = ['title','actions'];
    protected $table='cms_sliders';
    protected $with=['images'];
    protected static function newFactory()
    {
        return \CMS\Sliders\Database\factories\SlidersFactory::new();
    }

    public function images()
    {
       return $this->hasMany(SliderImages::class, 'slider_id', 'id');
    }
}
