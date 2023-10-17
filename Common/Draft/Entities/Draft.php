<?php

namespace Common\Draft\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Draft extends Model
{
    use HasFactory;

    protected $table='draft';
    protected $fillable = ['user_id', 'module', 'component','text_description','media_file'];
    
    protected static function newFactory()
    {
        return \Common\Draft\Database\factories\DraftFactory::new();
    }
}
