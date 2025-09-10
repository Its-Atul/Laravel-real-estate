<?php

namespace App\Mail;

use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your schedule is confirm',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $schedule = $this->data;
        $sitesetting = SiteSetting::find(1);
        return new Content(
            view: 'mail.schedule_mail',
            with: ['schedule' => $schedule, 'sitesetting' => $sitesetting],
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
