<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sku' => Str::random(10),
            'slug' => fake()->unique()->slug(),
            'price' => 100000,
            'price_sale' => 89000,
            'quantity' => 300,
            'image' => fake()->image(),
            'is_active' => 1,
            'is_featured' => fake()->boolean(),
            'is_best_seller' => fake()->boolean(),
            'is_new' => fake()->boolean(),
            'is_sale' => fake()->boolean(),
            'is_home' => fake()->boolean(),
            'is_hot' => fake()->boolean(),
            'brand_id' => Arr::random(Brand::all()->pluck('id')->toArray()),
        ];
    }
}
