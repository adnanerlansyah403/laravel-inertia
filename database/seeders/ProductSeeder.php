<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are some categories first
        $categories = Category::all();

        // Create sample products, each associated with a random category
        $products = [
            [
                'name' => 'Smartphone',
                'description' => 'A high-end smartphone with 128GB storage.',
                'image_url' => 'https://example.com/images/smartphone.jpg',
                'price' => 699,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Office Chair',
                'description' => 'Ergonomic office chair for maximum comfort.',
                'image_url' => 'https://example.com/images/office-chair.jpg',
                'price' => 250,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Lightweight running shoes for all terrains.',
                'image_url' => 'https://example.com/images/shoes.jpg',
                'price' => 120,
                'category_id' => $categories->random()->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
