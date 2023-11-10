<?php

namespace CMS\MainMenu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainMenu extends Model
{
    use HasFactory;

    protected $fillable = ['text','url_type','url','target'];
    protected $table='cms_main_menu';
    
    protected static function newFactory()
    {
        return \CMS\MainMenu\Database\factories\MainMenuFactory::new();
    }
}
