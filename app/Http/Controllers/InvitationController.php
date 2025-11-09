<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendInvitationMail;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvitationController extends Controller
{
    public function invitation(Request $request)
    {

        $guestIds = $request->input('ids', []);
        $contactIds = $request->input('ids', []);
        $eventIds = $request->input('event_ids', []);
        $contactIds = collect($contactIds)
            ->flatten()
            ->flatMap(fn($v) => explode(',', $v))
            ->filter()
            ->values()
            ->toArray();

        try {
            $guests = Guest::whereIn('id', $guestIds)->get();

            if ($guests->isNotEmpty()) {
                foreach ($guests as  $guest) {
                    dispatch(new SendInvitationMail($guest));
                }
            }
            $contacts = Contact::whereIn('id', $contactIds)->get() ?? [];
            if ($contacts->isNotEmpty()) {
                $selectedIds = [];
                if (isset($eventIds) && $eventIds[0] != '0') {
                    $selectedIds[] = $eventIds;
                }
                if (isset($eventIds) && count($eventIds) == 1  && $eventIds[0] === '0') {
                    $selectedIds[] = Event::all()->pluck('id')->toArray();
                }
                foreach ($contacts as  $guest) {
                    dispatch(new SendInvitationMail($guest, $selectedIds));
                }
            }
            $action = 'sentMail';
            if ($request->ajax() || $request->wantsJson()) {
                return api_success('', 'Invitations sent successfully', $action);
            }
            return redirect()->back()->with('success', 'Invitations sent successfully');
        } catch (\Throwable $th) {
            Log::error('Email failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
