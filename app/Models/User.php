<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'address',
        'avatar',
        'is_active',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public function productRatings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id', 'id');
    }

    public function isActive()
    {
        return $this->is_active == 1; // Hoặc return (bool) $this->is_active;
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class,'user_id','id');
    }

    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class, 'staff_id', 'id');
    }

    public function chatRoomCustomer()
    {
        return $this->hasone(ChatRoom::class, 'customer_id', 'id');
    }

}
