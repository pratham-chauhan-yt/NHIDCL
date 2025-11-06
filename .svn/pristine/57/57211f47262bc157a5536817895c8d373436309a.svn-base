<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;

    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    public function build()
    {
        // Use the simplest approach
        return $this->subject('Password Reset Request - NHIDCL')
            ->view('emails.reset-password', [
                'resetlink' => $this->resetUrl
            ]);
    }
}
