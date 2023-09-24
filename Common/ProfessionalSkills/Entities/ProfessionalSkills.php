<?php

namespace Common\ProfessionalSkills\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalSkills extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Common\ProfessionalSkills\Database\factories\ProfessionalSkillsFactory::new();
    }
}
