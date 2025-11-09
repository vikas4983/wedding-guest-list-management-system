<?php

namespace App\Services;

use App\Mail\InvitationMail;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvitationService
{

    public function sendInvitation($guest, $card)
    {
        try {
            Mail::to($guest->email)->send(new InvitationMail($guest, $card));
            return redirect()->back()->with('success', 'Invitation sent successfully');
        } catch (\Throwable $th) {
            Log::error('Mail failed'  . $th->getMessage(), [
                'id' => $guest->id,
                'name' => $guest->name,
                'card' => $card->id,
            ]);
        }
    }
}
