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
        'is_new',
        'is_featured',
        'is_best_seller'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_hot' => 'boolean',
        'is_sale' => 'boolean',
        'is_home' => 'boolean',
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
        'is_best_seller' => 'boolean'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'product_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

}
