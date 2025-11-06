<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSentMail
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
    public function handle(MessageSent $event) {
        // Log::info('Email sent', [
        //     'to' => $event->message->getTo(),
        //     'subject' => $event->message->getSubject(),
        //     'headers' => $event->message->getHeaders(),
        //     'body' => $event->message->getBody(),
        // ]);
    }
}
