<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = [
        'chat_room_id',
        'sender_id',
        'sender_name',
        'message'
    ];

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}
