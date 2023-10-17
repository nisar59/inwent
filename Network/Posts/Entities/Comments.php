<?php

namespace Network\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Comments extends Model
{
    use HasFactory;

    protected $table='network_post_comments';
    protected $fillable = ['user_id','post_id','parent_comment_id','comment_description'];
    protected $with=['user'];
    protected static function newFactory()
    {
        return \Network\Posts\Database\factories\CommentsFactory::new();
    }

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
