<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(), // Create and associate a product
            'user_id' => User::factory(), // Create and associate a user
            'review' => $this->faker->paragraph, // Generate a random review text
            'rating' => $this->faker->numberBetween(1, 5), // Random rating between 1 and 5
        ];
    }
}