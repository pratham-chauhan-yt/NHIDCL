<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DisclouserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $applicationId;
    public function __construct($user, $applicationId)
    {
        $this->user = $user;
        $this->applicationId = $applicationId;
    }


    public function build()
    {
        return $this->subject('Application submitted successfully - Resource Pool | NHIDCL')
            ->view('emails.disclouser')
            ->with([
                'applicationId' => $this->applicationId,
                'userId' => $this->user->id,
            ]);
    }
}
