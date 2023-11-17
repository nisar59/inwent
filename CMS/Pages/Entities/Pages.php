<?php

namespace CMS\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\Blocks\Entities\Blocks;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','meta_title','meta_description'];
    protected $table='cms_pages';
    
    protected static function newFactory()
    {
        return \CMS\Pages\Database\factories\PagesFactory::new();
    }
    public function blocks()
    {
        return $this->hasMany(Blocks::class, 'page_id', 'id');
    }
}
