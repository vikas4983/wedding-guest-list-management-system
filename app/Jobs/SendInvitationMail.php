<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use App\Models\Event;
use App\Services\InvitationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendInvitationMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $guest;
    protected $invitationService;

    public function __construct($guest)
    {
        $this->guest = $guest;
    }


    /**
     * Execute the job.
     */
    public function handle(InvitationService $invitationService): void
    {
        $guest = $this->guest;
        $this->invitationService = $invitationService;

        if ($guest->status === 1) {
            Log::info('Invitation already send', [
                'id' => $guest->id,
                'guest_name' => $guest->name,
            ]);
            return;
        }

        try {
            $activeEventNames  = Event::active()->pluck('name')->toArray();
            foreach ($guest->events as  $event) {
                if (in_array($event->name, $activeEventNames)) {
                    $card = $event->card;
                    $this->invitationService->sendInvitation($guest, $card);
                }
                $this->updateStatus($guest);
            }
        } catch (\Throwable $th) {
            Log::error('Invitation send failed', [
                'id' => $guest->id,
                'guest_name' => $guest->name,
                'error' => $th->getMessage(),
            ]);
        }
    }
    private function updateStatus($guest)
    {
        $guest->update([
            'status' => 1
        ]);
    }
}
