<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardCreateRequest;
use App\Services\StaticDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $staticDataService;


    public function __construct(StaticDataService $staticDataService)
    {
        $this->staticDataService = $staticDataService;
    }
    public function index(Request $request)
    {
        $cards = Card::latest()->paginate(10);
        if ($request->ajax() || $request->wantsJson()) {
            return api_success($cards, 'Cards retrieve successfully');
        }
        return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StaticDataService $staticDataService)
    {
        $data = $this->staticDataService->getData();
        return view('cards.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardCreateRequest $request)
    {
        $validatedData = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('cards', 'public');
                $validatedData['image'] = $path;
            }

            // $card = Card::updateOrCreate(['event_id' => $validatedData['event_id']], $validatedData);
            $card = Card::create($validatedData);
            if ($request->ajax() || $request->wantsJson()) {
                return api_created($card, 'Card created successfully');
            }
            return redirect()->back()->with('success', 'Card created successfully');
        } catch (\Throwable $th) {
            Log::error('Card failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Card $card, StaticDataService $staticDataService)
    {
        try {
            $objectdata = $card;
            $data = $staticDataService->getData();
            $editForm = view('forms.edit.cardForm', compact('objectdata', 'data'))->render();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'action' => 'edit',
                    'editForm' => $editForm
                ]);
            }
            return view('guests.edit', compact('objectdata'));
        } catch (\Throwable $th) {
            if ($request->ajax() || $request->wantsJson()) {
                Log::info('Data not found' . $th->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',

                ]);
            }
            Log::info('Data not found' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        try {
            $validatedData = app(\App\Http\Requests\CardCreateRequest::class)->validated();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $e->errors(),
                ], 422);
            }
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
        try {
            if (isset($validatedData['image'])) {
                if ($request->hasFile('image')) {
                    if (!empty($card->image) && Storage::disk('public')->exists($card->image)) {
                        Storage::disk('public')->delete($card->image);
                    }
                    $path = $request->file('image')->store('cards', 'public');
                    $validatedData['image'] = $path;
                }
            }
            $card->update($validatedData);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'action' => 'status',
                    'message' => 'Card updated successfully',
                ]);
            }
            return redirect()->route('cards.index')->with('success', 'Card updated successfully');
        } catch (\Throwable $th) {
            if ($request->ajax() || $request->wantsJson()) {
                Log::info('Updation failed' . $th->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                ]);
            }
            Log::info('Updation failed' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Card $card)
    {
        try {
            if ($card->image && Storage::disk('public')->exists($card->image)) {
                Storage::disk('public')->delete($card->image);
            }
            $card->destroy($card->id);
            if ($request->ajax() || $request->wantsJson()) {
                return api_success($card, 'Card deleted successfully', 'delete');
            }
            return redirect()->back()->with('success', 'Card deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Card deletion failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
