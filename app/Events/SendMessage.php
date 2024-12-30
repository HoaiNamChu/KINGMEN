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
    public $chatRoomId;

    public $senderId;

    public function __construct(ChatRoom $chatRoom, $senderId, Message $message)
    {
        $this->message = $message;
        $this->chatRoomId = $chatRoom->id;
        $this->senderId = $senderId;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('chat-support-' . $this->chatRoomId);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'chatRoomId' => $this->chatRoomId,
            'senderId' => $this->senderId,
        ];
    }
}
