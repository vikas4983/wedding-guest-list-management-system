<?php

namespace App\Services;

use App\Models\Event;

class StaticDataService
{
    public function getData()
    {
        $staticData = [
            'events' => Event::class
        ];
        $result = [];
        foreach ($staticData as $key => $data) {
            $result[$key] = $data::where('is_active', 1)->get();
        }
        return $result;
    }
}
