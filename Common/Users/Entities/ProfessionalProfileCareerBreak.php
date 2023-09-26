<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileCareerBreak extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','reason','start_date','end_date','currently_on_break'];
    protected $table='professional_profile_career_break';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileCareerBreakFactory::new();
    }
}
