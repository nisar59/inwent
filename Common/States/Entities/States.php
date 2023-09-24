<?php

namespace Common\States\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class States extends Model
{
    use HasFactory;

    protected $table='states';
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Common\States\Database\factories\StatesFactory::new();
    }
}
