<?php

namespace Network\SponsoredPosts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SponsoredPosts extends Model
{
    use HasFactory;
    protected $table='network_sponsored_posts';
    protected $fillable = ['name','corporation_business_name','corporation_business_avatar','description','media','media_type','action','action_text','action_description','status'];
    
    protected static function newFactory()
    {
        return \Network\SponsoredPosts\Database\factories\SponsoredPostsFactory::new();
    }

    public function getCorporationBusinessAvatarAttribute($value)
    {
        return StorageFile($value);
    }

    public function getMediaAttribute($value)
    {
        return StorageFile($value);
    }
}
