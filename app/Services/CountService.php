<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\Cache;

class CountService
{
    public function getCount()
    {

        return Cache::remember('count', 60, function () {
            return [
                'guests' => Guest::count(),
                'events' => Event::where('is_active', 1)->count(),
                'cards' => Card::where('is_active', 1)->count(),
                'contacts' => Contact::count(),
                'invited' => Guest::whereStatus(1)->count()
                    + Contact::whereStatus(1)->count(),
            ];
        });
    }
}
