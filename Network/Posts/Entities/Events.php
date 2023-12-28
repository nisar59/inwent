<?php

namespace Network\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;
    protected $table='network_post_events';
    protected $fillable = ['user_id','event_poster','event_start_date', 'event_end_date','event_description'];
    
    protected static function newFactory()
    {
        return \Network\Posts\Database\factories\EventsFactory::new();
    }
}
