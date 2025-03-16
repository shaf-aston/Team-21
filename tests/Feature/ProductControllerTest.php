<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;

class ProductControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_displays_all_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }



    /** @test */
    public function it_removes_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('admin.remove', $product->product_id));

        $response->assertRedirect(route('adminproducts.index'));
        $this->assertDatabaseMissing('products', ['product_id' => $product->product_id]);
    }

    // /** @test */
    // public function it_creates_a_new_product()
    // {
    //     $data = [
    //         'product_name' => 'Test Product',
    //         'product_price' => 100.50,
    //         'stock_quantity' => 10,
    //         'product_description' => 'A test product description.',
    //         'img_id' => 1,
    //         'category_id' => 1,
    //     ];

    //     $response = $this->post(route('products.store'), $data);

    //     $response->assertRedirect(route('adminproducts.index'));
    //     $this->assertDatabaseHas('products', ['product_name' => 'Test Product']);
    // }

    // /** @test */
    public function it_updates_stock_and_price()
    {
        $product = Product::factory()->create();

        $updateData = [
            'product_name' => $product->product_name,
            'product_price' => 150.00,
            'stock_quantity' => 5,
        ];

        $response = $this->post(route('products.updateStock', $product->product_id), $updateData);

        $response->assertRedirect(route('adminproducts.index'));
        $this->assertDatabaseHas('products', [
            'product_id' => $product->product_id,
            'product_price' => 150.00,
            'stock_quantity' => 5,
        ]);
    }
}
