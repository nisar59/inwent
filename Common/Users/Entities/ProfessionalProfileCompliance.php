<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileCompliance extends Model
{
    use HasFactory;

    protected $table='professional_profile_compliance';
    protected $fillable = ['user_id','professional_profile_id','description'];
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileComplianceFactory::new();
    }
}
