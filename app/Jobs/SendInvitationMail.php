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
    public $selectedIds;
    protected $invitationService;

    public function __construct($guest,  $selectedIds = [])
    {
        $this->guest = $guest;
        $this->selectedIds = $selectedIds;
       
    }


    /**
     * Execute the job.
     */
    public function handle(InvitationService $invitationService): void
    {
        $guest = $this->guest;
        $eventIds = $this->selectedIds;

        $this->invitationService = $invitationService;

        if ($guest->status === 1) {
            Log::info('Invitation already send', [
                'id' => $guest->id,
                'guest_name' => $guest->name,
            ]);
            return;
        }

        try {
            $activeEventNames  = Event::active()->pluck('name')->toArray() ?? [];
            if (!empty($guest->events)) {
                foreach ($guest->events as  $event) {
                    if (in_array($event->name, $activeEventNames)) {
                        $card = $event->card;
                        $this->invitationService->sendInvitation($guest, $card);
                    }
                    // $this->updateStatus($guest);
                }
            }
            $eventIds = collect($eventIds)->flatten()->toArray();
            if (!empty($eventIds)) {
                foreach ($eventIds as  $eventId) {
                    if ($event = Event::with('card')->find($eventId)) {
                        $card = $event->card;
                        Log::info($card);
                        $this->invitationService->sendInvitation($guest, $card);
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::error('Invitation send failed' . $th->getMessage(), [
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
