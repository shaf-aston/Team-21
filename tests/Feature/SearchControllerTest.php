<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{


    // Test the search functionality with valid data
    public function test_search_with_valid_data()
    {
        $product = Product::factory()->create([
            'product_name' => 'Testing Product',
            'product_description' => 'This is a test product.',
        ]);

        $response = $this->get('/search?query=test');

        $response->assertStatus(200);
        $response->assertViewIs('search.results');
        $response->assertViewHas('products', function ($products) use ($product) {
            return $products->contains($product);
        });
    }

    // Test the search functionality with invalid data (empty query)
    public function test_search_with_invalid_data()
    {
        $response = $this->get('/search'); // No query parameter provided
    
        $response->assertStatus(302); // Expecting a redirect due to validation failure
        $response->assertSessionHasErrors('query');
    }

         // Test product search with valid data
        public function test_product_search_with_valid_data()
        {
            $product = Product::factory()->create([
                'product_name' => 'Admin 2 Product',
                'product_description' => 'Description for admin product.',
            ]);
    
            $response = $this->get('/adminproduct/search?query=admin');
    
            $response->assertStatus(200);
            $response->assertViewIs('adminproductresult');
            $response->assertViewHas('products', function ($products) use ($product) {
                return $products->contains($product);
            });
        }
    
        // Test product search with invalid data (empty query)
        public function test_product_search_with_invalid_data()
        {
            // Perform a GET request with an invalid query (empty or invalid data)
            $response = $this->get('/adminproduct/search?query=');
        
            // Assert that the response status is 302 (redirect due to validation failure)
            $response->assertStatus(302); 
            
            // Assert that the session has errors for 'query' field
            $response->assertSessionHasErrors('query');
        }


        // Test order search with valid data
        public function test_search_orders_with_valid_data()
        {
            $order = Order::factory()->create([
                'order_id' => 124,
                'order_status' => 'PENDING',
            ]);
    
            $response = $this->get('/admin/search?query=124');
    
            $response->assertStatus(200);
            $response->assertViewIs('adminSearch.result');
            $response->assertViewHas('orders', function ($orders) use ($order) {
                return $orders->contains($order);
            });
        }

             
        
        public function test_order_search_with_invalid_data()
        {
            // Perform a GET request with an invalid query (empty or invalid data)
            $response = $this->get('/admin/search?query=');
        
            // Assert that the response status is 302 (redirect due to validation failure)
            $response->assertStatus(302); 
            
            // Assert that the session has errors for 'query' field
            $response->assertSessionHasErrors('query');
        }




}