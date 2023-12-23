<?php

namespace CMS\BlogCategories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;
class BlogCategories extends Model
{
    use HasFactory;
    protected $table='blog_categories';
    protected $fillable = ['name','slug','status'];
    
    protected static function newFactory()
    {
        return \CMS\BlogCategories\Database\factories\BlogCategoriesFactory::new();
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
