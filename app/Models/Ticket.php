<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    // Chỉ định bảng tương ứng nếu không theo quy tắc đặt tên
    protected $table = 'tickets';

    // Các trường có thể gán giá trị
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
