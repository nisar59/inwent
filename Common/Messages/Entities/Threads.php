<?php

namespace Common\Messages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class Threads extends Model
{
    use HasFactory;

    protected $table='chat_threads';
    protected $fillable = ['sender_id', 'receiver_id', 'module'];
    protected $with=['sender', 'receiver'];
    protected static function newFactory()
    {
        return \Common\Messages\Database\factories\ThreadsFactory::new();
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

}
