<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'image',
        'date',
        'time',
        'location',
        'address',
        'description',
        'theme_color',
        'rsvp_link',
        'is_active',
        'html',

    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
