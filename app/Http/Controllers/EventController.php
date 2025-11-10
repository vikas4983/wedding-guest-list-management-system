<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventCreateRequest;
use App\Http\responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $events = Event::paginate(10);
            if ($request->ajax() || $request->wantsJson()) {
                return api_success($events, 'Events retrieved successfully');
            }
            return view('events.index', compact('events'));
        } catch (\Throwable $th) {
            Log::error('Failed retrieved' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        try {
            $event =  Event::create($validatedData);
            if ($request->ajax() || $request->wantsJson()) {
                return api_created($event, 'Event added successfully');
            }
            return redirect()->back()->with('success', 'Event add successfully');
        } catch (\Throwable $th) {
            Log::error('Failed event:' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Event $event)
    {

        try {
            $objectData = $event;
            $editForm = view('forms.edit.eventForm', compact('objectData'))->render();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'action' => 'edit',
                    'editForm' => $editForm
                ]);
                $action = 'edit';
                return api_success($editForm, 'Data loaded successfully', $action);
            }
            return view('guests.edit', compact('objectdata'));
        } catch (\Throwable $th) {
            Log::error('Failed load:' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        try {
            $event->update($request->all());
            if ($request->ajax() || $request->wantsJson()) {
                $action = 'status';
                return api_success($event, 'Event Updated successfully', $action);
            }
            return redirect()->route('events.index')->with('success', 'Event updated successfully');
        } catch (\Throwable $th) {
            Log::error('Failed update:' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event)
    {

        try {
            $event->destroy($event->id);
            if ($request->ajax() || $request->wantsJson()) {
                $action = 'delete';
                unset($event['user_id']);
                return api_success($event, 'Event deleted successfully', $action);
            }
            return redirect()->back()->with('success', 'Event deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Failed delete:' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
