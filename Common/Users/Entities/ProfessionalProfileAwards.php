<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileAwards extends Model
{
    use HasFactory;

    protected $table='professional_profile_awards';
    protected $fillable = ['user_id', 'professional_profile_id', 'title', 'awarded_by','type','awarded_year'];
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileAwardsFactory::new();
    }
}
