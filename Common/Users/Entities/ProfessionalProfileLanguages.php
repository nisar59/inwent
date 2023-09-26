<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileLanguages extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','language','language_level','description'];
    protected $table='professional_profile_languages';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileLanguagesFactory::new();
    }
}
