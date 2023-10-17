<?php

namespace Network\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reactions extends Model
{
    use HasFactory;

    protected $table='network_post_reactions';
    protected $fillable = ['user_id','post_id','reaction'];
    
    protected static function newFactory()
    {
        return \Network\Posts\Database\factories\ReactionsFactory::new();
    }
}
