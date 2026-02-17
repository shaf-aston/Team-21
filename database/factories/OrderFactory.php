<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Assuming the user is created with the UserFactory
            'order_date' => Carbon::now(), // Set the current time for order date
            'order_status' => $this->faker->randomElement(['PENDING', 'SHIPPED', 'DELIVERED', 'CANCELLED']), // Example statuses
            'total_amount' => $this->faker->randomFloat(2, 20, 500), // Random total amount between 20 and 500
        ];
    }
}