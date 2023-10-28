<?php

namespace Network\Connects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Connects extends Model
{
    use HasFactory;

    protected $table='network_connects';
    protected $fillable = ['source_id','target_id','source_following','target_following','status'];
    
    protected static function newFactory()
    {
        return \Network\Connects\Database\factories\ConnectsFactory::new();
    }

}
