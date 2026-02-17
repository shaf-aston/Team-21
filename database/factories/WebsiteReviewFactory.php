<?php

namespace Database\Factories;

use App\Models\WebsiteReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteReviewFactory extends Factory
{
    protected $model = WebsiteReview::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Assuming you have a User factory and you're associating with a User
            'rating' => $this->faker->numberBetween(1, 5), // Rating between 1 and 5
            'review' => $this->faker->paragraph, // A random review paragraph
        ];
    }
}