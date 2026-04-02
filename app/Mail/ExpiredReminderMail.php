<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;

class ExpiredReminderMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
            from: new Address('noreply@domain.com', $this->data['sender'])
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.expired_reminder',
            with: [
                'name' => $this->data['name'],
                'expired_at' => $this->data['expired_at'],
                'jenis' => $this->data['jenis'] ?? '',
                'nomor' => $this->data['nomor'] ?? '',
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
