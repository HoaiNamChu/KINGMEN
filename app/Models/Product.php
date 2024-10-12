<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'price',
        'price_sale',
        'image',
        'short_desc',
        'description',
        'quantity',
        'is_active',
        'is_hot',
        'is_sale',
        'is_home',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_hot' => 'boolean',
        'is_sale' => 'boolean',
        'is_home' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries(){
        return $this->hasMany(Gallery::class, 'product_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function productComments(){
        return $this->hasMany(ProductComment::class);
    }

    public function productRatings(){
        return $this->hasMany(ProductRating::class);
    }
}
