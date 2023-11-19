<?php

namespace CMS\OURClient\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OURClient extends Model
{
    use HasFactory;

    protected $fillable = ['image'];
    protected $table='our_clients';
    
    protected static function newFactory()
    {
        return \CMS\OURClient\Database\factories\OURClientFactory::new();
    }
}
