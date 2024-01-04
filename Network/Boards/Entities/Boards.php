<?php

namespace Network\Boards\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class Boards extends Model
{
    use HasFactory;
    protected $table='network_boards';
    protected $fillable = ['user_id','title', 'slug','weblink','description','category_id','sub_category_id','tags', 'clip', 'clip_type', 'status'];
    protected $with=['user'];
    protected static function newFactory()
    {
        return \Network\Boards\Database\factories\BoardsFactory::new();
    }

    public function user()
    {
       return $this->hasOne(User::class, 'id', 'user_id');
    }

}
