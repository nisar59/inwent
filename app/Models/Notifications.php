<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Notifications extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $fillable=['notification_for', 'user_from','user_to','title','description','url','is_read'];
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
