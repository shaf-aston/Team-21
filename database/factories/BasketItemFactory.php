<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=BasketItem>
 */
class BasketItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Create a user using the UserFactory
            'product_id' => Product::factory(), // Create a product using the ProductFactory
            'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
        ];
    }
}
