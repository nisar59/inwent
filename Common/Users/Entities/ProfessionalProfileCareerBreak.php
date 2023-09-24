<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileCareerBreak extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileCareerBreakFactory::new();
    }
}
