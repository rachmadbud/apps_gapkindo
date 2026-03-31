<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpiredReminderMail extends Mailable
{
    public $data;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Reminder Expired')
            ->view('emails.expired_reminder')
            ->with([
                'name' => $this->data['name'],
                'expired_at' => $this->data['expired_at'],
            ]);
    }

    /**
     * Get the message envelope.    
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expired Reminder Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.expired_reminder', // ✅ ini yang benar
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
