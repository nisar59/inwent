<?php

namespace CMS\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\BlogCategories\Entities\BlogCategories;

class Blog extends Model
{
    use HasFactory;

    protected $table='blogs';
    protected $fillable = ['category_id','page_banner','thumbnail','title','slug','short_description','description'];
    protected $with=['blog_category'];
    protected static function newFactory()
    {
        return \CMS\Blog\Database\factories\BlogFactory::new();
    }

    public function getPageBannerAttribute($value)
    {
        return StorageFile($value);
    }

    public function getThumbnailAttribute($value)
    {
        return StorageFile($value);
    }

    public function blog_category()
    {
        return $this->hasOne(BlogCategories::class, 'id', 'category_id');
    }

}
