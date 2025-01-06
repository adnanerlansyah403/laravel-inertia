<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices, gadgets, and accessories'],
            ['name' => 'Clothing', 'description' => 'Men, women, and children apparel'],
            ['name' => 'Home & Kitchen', 'description' => 'Appliances, furniture, and cookware'],
            ['name' => 'Books', 'description' => 'Fiction, non-fiction, and educational materials'],
            ['name' => 'Sports', 'description' => 'Equipment and accessories for sports and fitness'],
        ];

        // Insert the categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
