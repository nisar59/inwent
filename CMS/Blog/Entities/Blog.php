<?php

namespace CMS\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','description'];
    protected $table='blog';
    
    protected static function newFactory()
    {
        return \CMS\Blog\Database\factories\BlogFactory::new();
    }
}
