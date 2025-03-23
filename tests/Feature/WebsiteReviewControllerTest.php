<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WebsiteReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteReviewControllerTest extends TestCase
{


    /** @test */
    public function it_stores_a_review_successfully()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('websitereviews.store'), [
            'review' => 'This is a great website!',
            'rating' => 5,
        ]);

        $response->assertRedirect()->assertSessionHas('success', 'Review submitted successfully');

        $this->assertDatabaseHas('websitereviews', [
            'user_id' => $user->id,
            'review' => 'This is a great website!',
            'rating' => 5,
        ]);
    }

    /** @test */
    public function it_requires_review_and_rating_fields()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('websitereviews.store'), []);

        $response->assertSessionHasErrors(['review', 'rating']);
    }


}
