<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\SupplierOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SupplierOrderControllerTest extends TestCase
{


    //Test: Showing the 'create' form
    public function test_show_create_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();  // Assuming a Product factory exists

        $response = $this->get('/supplier-orders/create');

        $response->assertStatus(200);
        $response->assertViewIs('supplierorders.create');
        $response->assertViewHas('products', function ($products) use ($product) {
            return $products->contains($product);
        });
    }

    // Test: Store a supplier order with valid data
    public function test_store_supplier_order_with_valid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create(['product_price' => 100]);  // Assuming a Product factory exists

        // Simulate a valid request for supplier order creation
        $response = $this->post(route('supplier-orders.store'), [
            'supplier_name' => 'Supplier A',
            'product_id' => [$product->product_id],
            'quantity' => [2],
        ]);

        $response->assertRedirect(route('supplier-orders.index'));
        $response->assertSessionHas('success', 'Supplier order placed successfully!');

        // Check that the supplier order is stored in the database
        $this->assertDatabaseHas('supplier_orders', [
            'supplier_name' => 'Supplier A',
            'total_amount' => 160,  // Assuming a 20% discount on the product price (100 * 0.8 * 2)
        ]);

        $this->assertDatabaseHas('supplier_order_items', [
            'product_id' => $product->product_id,
            'quantity' => 2,
            'unit_price' => 80,  // Discounted price (100 * 0.8)

        ]);
    }


}