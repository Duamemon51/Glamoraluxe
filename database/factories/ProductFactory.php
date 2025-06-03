<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(), // Create a product with a category
            'name' => $this->faker->word, // Fake product name
            'description' => $this->faker->sentence, // Fake description
            'price' => $this->faker->randomFloat(2, 10, 100), // Fake price between 10 to 100
            'image_url' => 'product_image.jpg', // Fake product image
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']), // Random size
            'color' => $this->faker->safeColorName, // Random color
            'stock_quantity' => $this->faker->numberBetween(10, 100), // Random stock quantity
           // In ProductFactory
'status' => $this->faker->randomElement(['in_stock', 'out_of_stock']),
// Randomly assigns 'in stock' or 'out of stock'

        ];
    }
}
