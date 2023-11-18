<?php

namespace Common\Messages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class Messages extends Model
{
    use HasFactory;

    protected $table='chat_messages';
    protected $fillable = ['thread_id','sender_id', 'message_type','content'];
    protected $with=['user'];
    protected static function newFactory()
    {
        return \Common\Messages\Database\factories\MessagesFactory::new();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
