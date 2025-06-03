<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        // Create a "Footwear" category
        $footwearCategory = Category::create([
            'name' => 'Footwear',
            'image' => 'footwear.png', // Use the appropriate image for footwear
        ]);

        // Create 10 fake products for the "Footwear" category
        Product::factory()->count(10)->create([
            'category_id' => $footwearCategory->id,
        ]);

        // Create other categories and products as needed
        $clothingCategory = Category::create([
            'name' => 'Clothing',
            'image' => 'clothing.png', // Use the appropriate image for clothing
        ]);

        Product::factory()->count(10)->create([
            'category_id' => $clothingCategory->id,
        ]);

        // Add more categories as needed
    }
}
