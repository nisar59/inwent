<?php

namespace CMS\Blocks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blocks extends Model
{
    use HasFactory;

    protected $fillable = ['page_id','block_name','file_name','data','sort_by'];
    protected $table='page_blocks';

    protected static function newFactory()
    {
        return \CMS\Blocks\Database\factories\BlocksFactory::new();
    }
}
