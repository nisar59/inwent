<?php

namespace Freelancing\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class ProjectProposals extends Model
{
    use HasFactory;

    protected $table='freelancing_project_proposals';
    protected $fillable = ['user_id', 'project_id','cover_letter','scope','bidding_price','project_duration','query','attachments','agree_to_terms'];
    protected $with=['user'];
    protected static function newFactory()
    {
        return \Freelancing\Projects\Database\factories\ProjectProposalsFactory::new();
    }

    public function user()
    {
       return $this->hasOne(User::class, 'id', 'user_id');
    }
}
