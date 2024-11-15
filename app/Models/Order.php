<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'email',
        'status',
        'payment_method',
        'payment_status',
        'shipping_fee',
        'shipping_method',
        'shipping_status',
        'discount',
        'total',
    ];

//    protected $casts = [
//        'status' =>  'enum',
//        'payment_status' =>  'enum',
//        'payment_method' =>  'enum'
//    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
