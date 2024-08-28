<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarEventsNotifications extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $event_id;
    public $message;
    public function __construct($event_id, $message)
    {
        $this->event_id = $event_id;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [

            'event_id' => $this->event_id,
            'message' => $this->message,
        ];
    }
}