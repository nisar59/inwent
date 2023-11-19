<?php

namespace CMS\OurClient\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurClient extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['image'];
    protected $table='our_clients';
=======
   	protected $fillable = ['image'];
    protected $table='our_client';
>>>>>>> a641e6da61707e6692674ec7ee1a6a7e399f0426
    
    
    protected static function newFactory()
    {
        return \CMS\OurClient\Database\factories\OurClientFactory::new();
    }
}
