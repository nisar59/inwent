<?php

namespace Common\Cities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cities extends Model
{
    use HasFactory;

    protected $table='cities';
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Common\Cities\Database\factories\CitiesFactory::new();
    }
}
