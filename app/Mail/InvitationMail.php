<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $guest;
    public $card;

    public function __construct($guest, $card)
    {

        $this->guest = $guest;
        $this->card = $card;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->card->title ?? 'Invitation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $body = Blade::render(
            $this->card->html ?: '<p>No template found.</p>',
            ['card' => $this->card, 'guest' => $this->guest]
        );
        return new Content(
            view: 'emails.event-invitation',
            with: [
                'body' => $body,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
