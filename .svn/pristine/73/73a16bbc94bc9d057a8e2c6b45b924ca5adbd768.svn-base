<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class UserNotification extends Notification
{
    use Queueable, SerializesModels;

    protected  $message;
    protected $link;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $link = null)
    {
        $this->message = $message;
        $this->link = $link;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'read_at' => null // Or current timestamp for read notifications
        ];
    }

    public function broadcastOn()
    {
        return ['notifications'];
    }

    public function broadcastAs()
    {
        return 'user-notification';
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => $this->link,  // Add link to the database payload
        ];
    }
}
