<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class NewUserSetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $resetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
        $basePath = session("moduleName")
        ? "/recruitment-portal/password/reset"
        : "/password/reset";
        $this->resetUrl = url("{$basePath}/{$token}?email=" . urlencode($user->email));

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Set Your Password – NHIDCL ' . (session("moduleName") ?? "Recruitment Portal"),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_user_set_password',
            with: [
                'user' => $this->user,
                'token' => $this->token,
                'resetUrl' => $this->resetUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if (session("moduleName")) {
            // Use public_path instead of asset()
            $filePath = public_path('pdf/RP_USER_MANUAL.pdf'); // correct server path

            if (file_exists($filePath)) {
                return [
                    Attachment::fromPath($filePath)
                        ->as('RP_USER_MANUAL.pdf')       // rename attachment if needed
                        ->withMime('application/pdf'),
                ];
            }
        }

        return [];
    }
}
