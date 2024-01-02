<?php

namespace CMS\KnowledgeBaseCategories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KnowledgeBaseCategories extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug', 'icon', 'description'];
    protected $table='knowledge_base_categories';
    
    protected static function newFactory()
    {
        return \CMS\KnowledgeBaseCategories\Database\factories\KnowledgeBaseCategoriesFactory::new();
    }

    public function getIconAttribute($value)
    {
        return StorageFile($value);
    }

    

}
