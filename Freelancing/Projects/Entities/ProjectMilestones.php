<?php

namespace Freelancing\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectMilestones extends Model
{
    use HasFactory;
    protected $table='freelancing_projects_milestones';
    protected $fillable = ['project_id', 'user_from', 'user_to','milstone_price','expected_closing_date','name','description','status','completion_date','request_completion','work_files','explaination','request_status','paid','pay_description','agree_to_terms'];
    
    protected static function newFactory()
    {
        return \Freelancing\Projects\Database\factories\ProjectMilestonesFactory::new();
    }
}
