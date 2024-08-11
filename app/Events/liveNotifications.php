<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class liveNotifications implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $reciver_id;
    public function __construct($reciver_id , protected Chat $chat)
    {
        $this->reciver_id = $reciver_id;
    }

    function broadcastWith() : array {
        return [
            'reciver_id' => $this->reciver_id,
            'chat' => [
                'chat_id' => $this->chat->id,
                'user_id' => $this->chat->user->id,
                'contact_id' => $this->chat->contact->id,
            ]
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('liveNotification.' . $this->reciver_id),
        ];
    }
}
