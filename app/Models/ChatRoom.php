<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_session_id',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'staff_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_room_id');
    }

    public function staff(){
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
