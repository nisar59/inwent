<?php

namespace CMS\KnowledgeBase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CMS\KnowledgeBaseCategories\Entities\KnowledgeBaseCategories;

class KnowledgeBase extends Model
{
    use HasFactory;

    protected $fillable = ['knowledge_base_category_id','title','description'];
    protected $table='knowledge_base';
    
    protected static function newFactory()
    {
        return \CMS\KnowledgeBase\Database\factories\KnowledgeBaseFactory::new();
    }
     public function fetch_Know_base_cate()
    {
    	return $this->belongsTo(KnowledgeBaseCategories::class,'knowledge_base_category_id','id');
    }

}
