<?php

namespace Common\Languages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Languages extends Model
{
    use HasFactory;

    protected $table='world_languages';
    protected $fillable = ['code', 'lang'];
    
    protected static function newFactory()
    {
        return \Common\Languages\Database\factories\LanguagesFactory::new();
    }
}
