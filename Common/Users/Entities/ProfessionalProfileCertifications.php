<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileCertifications extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','certificate_title','others','certificate_name','issued_by','certificate_number','validity_start_date','validity_end_date','no_expiry'];
    protected $table='professional_profile_certifications';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileCertificationsFactory::new();
    }
}
