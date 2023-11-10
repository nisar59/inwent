<?php

namespace Freelancing\ProjectConfig\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectConfig extends Model
{
    use HasFactory;

    protected $fillable = ['type','name','description'];
    protected $table='project_config';
    
    protected static function newFactory()
    {
        return \Freelancing\ProjectConfig\Database\factories\ProjectConfigFactory::new();
    }
}
