<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class UserRatings extends Model
{
    use HasFactory;
    protected $table='user_ratings';
    protected $fillable=['user_from','user_to','status','total_rating_given','field_knowledge','subject_knowledge','skills','qualification','experience','achievements','community_participation','survey_participation'];
    protected $with=['userfrom', 'userto'];

    public function userfrom()
    {
        return $this->hasOne(User::class, 'id', 'user_from');
    }
    public function userto()
    {
        return $this->hasOne(User::class, 'id', 'user_to');
    }
}
