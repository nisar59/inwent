<?php

namespace Network\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Network\Posts\Entities\Media;
use Network\Posts\Entities\Comments;
use Network\Posts\Entities\Reactions;
use App\Models\User;
class Posts extends Model
{
    use HasFactory;

    protected $table='network_posts';
    protected $fillable = ['user_id','slug','post_description'];
    
    protected static function newFactory()
    {
        return \Network\Posts\Database\factories\PostsFactory::new();
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(Reactions::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }

}
