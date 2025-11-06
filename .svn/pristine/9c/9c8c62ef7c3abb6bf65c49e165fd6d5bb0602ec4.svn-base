<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogFailedMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSending $event){
        $toAddresses = $event->message->getTo();
        $toEmails = [];

        if (is_array($toAddresses)) {
            foreach ($toAddresses as $address) {
                $toEmails[] = $address->getAddress(); // Get actual email string
            }
        }

        // Log::info('Attempting to send email', [
        //     'to' => $toEmails,
        //     'subject' => $event->message->getSubject(),
        // ]);
    }
}
