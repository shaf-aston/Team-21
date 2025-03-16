<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderControllerTest extends TestCase
{



    public function testUpdateStatus()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        $response = $this->actingAs($user)->post(route('orders.adminUpdateStatus', ['order' => $order->order_id]), [
            'order_status' => 'shipped',
        ]);

        $response->assertRedirect(route('orders.adminIndex'));
        $this->assertDatabaseHas('orders', ['order_id' => $order->order_id, 'order_status' => 'shipped']);
    }



}