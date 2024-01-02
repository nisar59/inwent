<?php

namespace CMS\KnowledgeBase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\KnowledgeBaseCategories\Entities\KnowledgeBaseCategories;

class KnowledgeBase extends Model
{
    use HasFactory;

    protected $fillable = ['knowledge_base_category_id','title','short_description','description'];
    protected $table='knowledge_base';
    protected $with=['category'];
    protected static function newFactory()
    {
        return \CMS\KnowledgeBase\Database\factories\KnowledgeBaseFactory::new();
    }
     public function category()
    {
    	return $this->belongsTo(KnowledgeBaseCategories::class,'knowledge_base_category_id','id');
    }

}
