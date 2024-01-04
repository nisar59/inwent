<?php

namespace Network\BoardsCategories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoardsCategories extends Model
{
    use HasFactory;
    protected $table='network_boards_categories';
    protected $fillable = ['title', 'slug', 'parent_id'];
    protected $with=['sub_categories'];
    protected static function newFactory()
    {
        return \Network\BoardsCategories\Database\factories\BoardsCategoriesFactory::new();
    }

    public function sub_categories()
    {
      return $this->hasMany(BoardsCategories::class, 'parent_id', 'id');
    }
}
