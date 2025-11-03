<?php

namespace App\Services;

use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvitationService
{

    public function sendInvitation($guest)
    {
        Mail::to($guest->email)->send(new InvitationMail($guest));
        Log::info('Invitation sent and status update', [
            'id' => $guest->id,
            'name' => $guest->name,
        ]);
    }
}
