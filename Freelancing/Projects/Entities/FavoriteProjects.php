<?php

namespace Freelancing\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FavoriteProjects extends Model
{
    use HasFactory;

    protected $table='freelancing_projects_favorites';
    protected $fillable = ['user_id', 'project_id'];
    
    protected static function newFactory()
    {
        return \Freelancing\Projects\Database\factories\FavoriteProjectsFactory::new();
    }
}
