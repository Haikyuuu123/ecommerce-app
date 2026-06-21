<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $categories = collect([
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Smart everyday devices and accessories.'],
            ['name' => 'Home Office', 'slug' => 'home-office', 'description' => 'Comfortable tools for productive workspaces.'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Useful items for daily routines.'],
        ])->map(fn ($category) => Category::create($category));

        Product::insert([
            [
                'category_id' => $categories[0]->id,
                'name' => 'Wireless Headphones',
                'slug' => 'wireless-headphones',
                'description' => 'Noise-reducing headphones with long battery life and comfortable ear cushions.',
                'price' => 89.99,
                'stock' => 18,
                'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smart Watch',
                'slug' => 'smart-watch',
                'description' => 'A lightweight watch for notifications, workouts, and daily health tracking.',
                'price' => 129.00,
                'stock' => 11,
                'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Ergonomic Desk Chair',
                'slug' => 'ergonomic-desk-chair',
                'description' => 'Supportive chair with adjustable height, breathable fabric, and sturdy frame.',
                'price' => 219.50,
                'stock' => 7,
                'image_url' => 'https://images.unsplash.com/photo-1580480055273-228ff5388ef8?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Mechanical Keyboard',
                'slug' => 'mechanical-keyboard',
                'description' => 'Compact keyboard with tactile switches, white backlight, and USB-C connection.',
                'price' => 74.25,
                'stock' => 24,
                'image_url' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Canvas Travel Backpack',
                'slug' => 'canvas-travel-backpack',
                'description' => 'Durable backpack with laptop space, padded straps, and weather-resistant fabric.',
                'price' => 58.00,
                'stock' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Minimal Desk Lamp',
                'slug' => 'minimal-desk-lamp',
                'description' => 'Adjustable LED lamp with warm and cool settings for reading or focused work.',
                'price' => 42.75,
                'stock' => 5,
                'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
