<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Category::factory(10)->create();
         \App\Models\Brand::factory(15)->create();
        \App\Models\Tag::factory(20)->create();
        \App\Models\Slide::factory(5)->create();

        Product::factory(20)->create();

//        Gallery::factory(20)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
