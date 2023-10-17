<?php

namespace Network\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $table='network_post_media';

    protected $fillable = ['post_id','media_type','media_file'];
    
    protected static function newFactory()
    {
        return \Network\Posts\Database\factories\MediaFactory::new();
    }
}
