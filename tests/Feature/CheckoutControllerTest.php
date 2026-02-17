<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\BasketItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutControllerTest extends TestCase
{
  
    /** @test */
    public function test_checkout_page_loads_correctly()
    {
        $response = $this->get(route('checkout.show'));
        $response->assertStatus(200);
        $response->assertViewIs('checkout2');
    }

    /** @test */
    public function test_checkout_fails_with_invalid_data()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->post(route('checkout.verify'), []);
        $response->assertSessionHasErrors([
            'fullName', 'email', 'phone', 'address', 'city', 'zip',
            'cardName', 'cardNumber', 'expiryDate', 'cvv'
        ]);
    }

    /** @test */
    public function test_checkout_succeeds_with_valid_data()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create(['stock_quantity' => 10, 'product_price' => 100]);
        BasketItem::factory()->create(['user_id' => $user->id, 'product_id' => $product->product_id, 'quantity' => 2]);

        $response = $this->post(route('checkout.verify'), [
            'fullName' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Springfield',
            'zip' => '12345',
            'cardName' => 'John Doe',
            'cardNumber' => '4111111111111111',
            'expiryDate' => '2025-12',
            'cvv' => '123',
        ]);

        $response->assertRedirect(route('checkout.show'));
        $response->assertSessionHas('success', 'Payment processed successfully!');

        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'order_status' => 'PENDING']);
        $this->assertDatabaseHas('shipping', ['shipping_status' => 'PENDING']);
        $this->assertDatabaseHas('order_items', ['product_id' => $product->product_id, 'quantity' => 2]);

        $product->refresh();
        $this->assertEquals(8, $product->stock_quantity);
    }




}