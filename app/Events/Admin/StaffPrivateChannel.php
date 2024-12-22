<?php

namespace App\Events\Admin;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StaffPrivateChannel implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $staffId;

    public function __construct($message, $staffId)
    {
        $this->message = $message;
        $this->staffId = $staffId;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('staff-private-channel-'.$this->staffId);
    }

    public function broadcastWith(){
        return [
            'message' => $this->message,
        ];
    }
}
