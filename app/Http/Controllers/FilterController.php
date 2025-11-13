<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Services\FilterService;
use FilterIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    protected $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }
    public function filter(Request $request)
    {

        $keyword = trim($request->input('keyword', ''));
        $url = trim($request->input('url', ''));
        if ($keyword === '') {
            return redirect()->back()->with('error', 'Please enter a keyword');
        }
        $guests = $this->filterService->filter($keyword, $url);
        if ($url === 'guests') {
            return view('guests.index', compact('guests'))->with('success', 'you have found record');
        }
        if ($url === 'contacts') {
            $contacts =  $guests;
            return view('contacts.index', compact('contacts'))->with('success', 'you have found record');
        }
        // if ($url === 'invited') {
        //     $contacts =  $guests;
        //     $dataList = '';
        //     return view('invitations.index', compact('contacts', 'dataList'))->with('success', 'you have found record');
        // }
    }
}
