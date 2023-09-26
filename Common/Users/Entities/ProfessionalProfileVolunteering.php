<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileVolunteering extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','role','others','organization','description','validity_start_date','validity_end_date','no_expiry'];
    protected $table='professional_profile_volunteering';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileVolunteeringFactory::new();
    }
}
