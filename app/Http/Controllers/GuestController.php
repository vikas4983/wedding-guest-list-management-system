<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuestCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::paginate(5);
        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestCreateRequest $request)
    {

        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $validatedData['user_id'] = Auth::user()->id;
            Guest::create($validatedData);
            Log::info('Invitation send successfully');
            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Invitation send successfully',
                ]);
            }
            return redirect()->back()->with('success', 'Invitation sent successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info('Invitation failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong'
                ], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        try {
            $objectdata = Guest::find($id);
            $editForm = view('forms.edit.guestForm', compact('objectdata'))->render();
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
    public function update(GuestCreateRequest $request, Guest $guest)
    {
        $validatedData = $request->validated();
        try {
            if ($guest) {
                $guest->update($validatedData);
            }
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'action' => 'update',
                    'message' => 'Guest updated successfully',
                ]);
            }
            return redirect()->route('guests.index')->with('success', 'Guest updated successfully');
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
    public function destroy(Guest $guest, Request $request)
    {
        $guest->destroy($guest->id);
        if ($request->ajax() || $request->wantsjson()) {
            return response()->json([
                'action' => 'delete',
                'success' => 'true',
                'message' => 'Item deleted successfully',
            ]);
        }
        return redirect()->back()->with('error', ' Item deleted successfully');
    }
}
