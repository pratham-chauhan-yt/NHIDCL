<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class GrievanceAssigned extends Notification
{
    use Queueable;

    public $grievance;


    public function __construct(\App\Models\Grievance $grievance)
    {
        $this->grievance = $grievance;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('New Grievance Assigned')
        ->line('A new grievance has been assigned to you: ' . substr($this->grievance->description, 0, 120))
        ->action('View Grievance', url('/grievance-management/grievance/details/'.Crypt::encrypt($this->grievance->id)))
        ->line('Please handle it as per policy.');
    }

    public function toArray($notifiable)
    {
        return ['grievance_id' => $this->grievance->id, 'type' => $this->grievance->type];
    }
}