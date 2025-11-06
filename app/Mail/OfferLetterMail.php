<?php

namespace App\Mail;

use App\Models\ResourcePool\NhidclResourceRequisitionFinalShortlistApplicant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OfferLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $shortlist;

    public function __construct(User $user, NhidclResourceRequisitionFinalShortlistApplicant $shortlist)
    {
        $this->user = $user;
        $this->shortlist = $shortlist;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Offer Letter – Resource Pool | NHIDCL',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.offer_letter',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $fileName = $this->shortlist->offer_letter_file;
        $pathName = 'uploads/hr/upload_offer_letter/';
        $fullPath = viewFilePath($pathName) . urldecode($fileName);

        if ($fileName && $pathName && file_exists($fullPath)) {
            return [
                Attachment::fromPath($fullPath)
                    ->as('Offer-Letter.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
