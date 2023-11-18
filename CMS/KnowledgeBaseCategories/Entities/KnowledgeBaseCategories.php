<?php

namespace CMS\KnowledgeBaseCategories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KnowledgeBaseCategories extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    protected $table='knowledge-base-categories';
    
    protected static function newFactory()
    {
        return \CMS\KnowledgeBaseCategories\Database\factories\KnowledgeBaseCategoriesFactory::new();
    }

    

}
