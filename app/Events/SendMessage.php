<?php

namespace App\Events;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public $userId;

    public function __construct(Message $message, $userId = null)
    {
        $this->message = $message;

        $this->userId = $userId;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('chat-support-' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'senderId' => $this->message->sender_id,
            'message' => $this->message->message,
        ];
    }
}
