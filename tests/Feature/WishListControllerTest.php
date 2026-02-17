<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\WishListItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishListControllerTest extends TestCase
{


    public function test_user_can_view_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        WishListItem::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('wishlist.index'));

        $response->assertStatus(200);
        $response->assertViewIs('wishlist2');
        $response->assertViewHas('wishListItems');
    }

    public function test_guest_cannot_add_product_to_wishlist()
    {
        $product = Product::factory()->create();

        $response = $this->post(route('wishlist.add'), [
            'product_id' => $product->product_id,
            'quantity' => 1,
        ]);

        $response->assertRedirect('login');
        
    }

    public function test_user_can_add_product_to_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('wishlist.add'), [
            'product_id' => $product->product_id,
            'quantity' => 2,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('wishlist_items', [
            'user_id' => $user->id,
            'product_id' => $product->product_id,
            'quantity' => 2,
        ]);
    }

    public function test_user_can_remove_product_from_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $wishlistItem = WishListItem::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('wishlist.remove', $wishlistItem->id));

        $response->assertRedirect(route('wishlist.index'));
        $this->assertDatabaseMissing('wishlist_items', ['id' => $wishlistItem->id]);
    }

    public function test_user_can_update_wishlist_item_quantity()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $wishlistItem = WishListItem::factory()->create(['user_id' => $user->id, 'quantity' => 1]);

        $response = $this->put(route('wishlist.update', $wishlistItem->id), ['quantity' => 5]);

        $response->assertRedirect(route('wishlist.index'));
        $this->assertDatabaseHas('wishlist_items', ['id' => $wishlistItem->id, 'quantity' => 5]);
    }


}