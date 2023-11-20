<?php

namespace CMS\UserReviews\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserReviews extends Model
{
    use HasFactory;

    protected $fillable = ['name','designation','image','review'];
    protected $table='user_reviews';
    
    protected static function newFactory()
    {
        return \CMS\UserReviews\Database\factories\UserReviewsFactory::new();
    }
}
