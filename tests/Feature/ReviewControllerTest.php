<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{


    /**
     * Test storing a review.
     *
     * @return void
     */
    public function test_store_review()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        
        $data = [
            'review' => 'This is a great product!',
            'rating' => 5,
        ];

        
        $response = $this->post(route('reviews.store', $product->product_id), $data);

     
        $this->assertDatabaseHas('reviews', [
            'product_id' => $product->product_id,
            'user_id' => $user->id,
            'review' => 'This is a great product!',
            'rating' => 5,
        ]);

        $response->assertRedirect()->with('success', 'Review submitted successfully');
    }

    /**
     * Test validation for storing a review.
     *
     * @return void
     */
    public function test_store_review_validation()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('reviews.store', $product->product_id), [
            'rating' => 5,
        ]);
        $response->assertSessionHasErrors('review');

        $response = $this->post(route('reviews.store', $product->product_id), [
            'review' => 'Great product!',
            'rating' => 6,
        ]);
        $response->assertSessionHasErrors('rating');
    }

}