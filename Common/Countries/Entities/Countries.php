<?php

namespace Common\Countries\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Countries extends Model
{
    use HasFactory;

    protected $table='countries';
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Common\Countries\Database\factories\CountriesFactory::new();
    }
}
