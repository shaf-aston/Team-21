<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'product_id' => $this->faker->numberBetween(300, 1000),
            'product_name' => $this->faker->word,
            'product_description' => $this->faker->sentence,
            'product_price' => $this->faker->randomFloat(2, 10, 500), // Random price between 10 and 500
            'stock_quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'img_id' => $this->faker->randomNumber(), // Assuming img_id is a number
            'category_id' => $this->faker->numberBetween(1, 5), // Assuming category_id is a foreign key
            'img_address' => $this->faker->imageUrl(),
        ];
    }
}
