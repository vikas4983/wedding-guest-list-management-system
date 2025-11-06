<?php

namespace App\Services;

use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvitationService
{

    public function sendInvitation($guest, $card)
    {
        try {
            Mail::to($guest->email)->send(new InvitationMail($guest, $card));
        } catch (\Throwable $th) {
            Log::error('Mail failed'  . $th->getMessage(), [
                'id' => $guest->id,
                'name' => $guest->name,
                'card' => $card->id,
            ]);
        }
    }
}
