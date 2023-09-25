<?php

namespace Common\ProfessionalTools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalTools extends Model
{
    use HasFactory;

    protected $fillable = ['type','title'];
    protected $table='professional_tools';
    
    protected static function newFactory()
    {
        return \Common\ProfessionalTools\Database\factories\ProfessionalToolsFactory::new();
    }
}
