<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendInvitationMail;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvitationController extends Controller
{
    public function invitation(Request $request)
    {
        $ids = $request->input('ids', []);

        try {
            $guests = Guest::whereIn('id', $ids)->get();
            foreach ($guests as  $guest) {
                dispatch(new SendInvitationMail($guest));
            }
            $action = 'sentMail';
            if ($request->ajax() || $request->wantsJson()) {
                return api_success('', 'Invitations sent successfully', $action);
            }
            return redirect()->back()->with('success', 'Invitations email sent successfully');
        } catch (\Throwable $th) {
            Log::error('Email failed' . $th->getMessage());
            return api_error('Something went wrong');
        }
    }
}
