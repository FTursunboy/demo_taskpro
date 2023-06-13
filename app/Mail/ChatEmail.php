<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChatEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $task;
    public $message1;


    public function __construct($task, $message)
    {
        $this->task = $task;
        $this->message1 = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            from: new Address('fingroup.task@gmail.com', 'FinGroup'),
            subject: 'FinGroup',
        );
    }

    /**
     * Get the message content definition.
     */

    public function content(): Content
    {
        return new Content(
            view: 'mail.reportFromClient1',
            with: [
                'task' => $this->task,
                'message1' => $this->message1,
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

