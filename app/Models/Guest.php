<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public $fillable = ['user_id', 'name', 'email', 'phone','status'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_guest', 'guest_id', 'event_id');
    }
}
