<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class FilterService
{
    public function filter($keyword, $url)
    {


        if ($url === 'guests') {
            $query = Guest::query();
            $query =  $this->keyword($keyword,  $query);
            return $query->paginate(1);
        }
        if ($url === 'contacts') {
            $query = Contact::query();
            $query = $this->keyword($keyword,  $query);

            return $query->paginate(1);
        }
        // if ($url === 'invited') {
        //     $query = Contact::query() ?? '';
        //     $query = Guest::query() ?? '';
        //     $query = $this->keyword($keyword,  $query);
        //     return $query->paginate(1);
        // }
    }

    public function keyword($keyword, $query)
    {
        if (ctype_digit($keyword)) {
            $query->orWhere('id', $keyword);
        }
        if (str_contains($keyword, '@')) {
            $query->orWhere('email', $keyword);
        }
        if (str_contains($keyword, '')) {
            $query->orWhere(DB::raw('LOWER(name)'), strtolower($keyword));
        }
        $digits = preg_replace('/\D+/', '', $keyword);
        if ($digits !== '') {
            $query->orWhere('phone', $digits);
        }
        return $query;
    }
}
