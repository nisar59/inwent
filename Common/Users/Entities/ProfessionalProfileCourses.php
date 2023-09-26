<?php

namespace Common\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalProfileCourses extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professional_profile_id','course_title','issued_by','course_description','start_date','end_date','currently_enrolled'];
    protected $table='professional_profile_courses';
    
    protected static function newFactory()
    {
        return \Common\Users\Database\factories\ProfessionalProfileCoursesFactory::new();
    }
}
