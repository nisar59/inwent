<?php

namespace CMS\Categories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['title','icone'];
    protected $table='categories';
    
    protected static function newFactory()
    {
        return \CMS\Categories\Database\factories\CategoriesFactory::new();
    }
}
