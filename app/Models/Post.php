<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'is_home',
        'is_active',
    ];

    protected $casts = [
        'is_home' => 'boolean',
        'is_active' => 'boolean',
    ];
}
