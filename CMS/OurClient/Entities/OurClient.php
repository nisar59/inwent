<?php

namespace CMS\OurClient\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurClient extends Model
{
    use HasFactory;
    protected $fillable = ['image'];
    protected $table='our_clients';
    
    protected static function newFactory()
    {
        return \CMS\OurClient\Database\factories\OurClientFactory::new();
    }
}
