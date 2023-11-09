<?php

namespace CMS\Sliders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sliders extends Model
{
    use HasFactory;

    protected $fillable = ['title','actions'];
    protected $table='cms_sliders';
    
    protected static function newFactory()
    {
        return \CMS\Sliders\Database\factories\SlidersFactory::new();
    }
}
