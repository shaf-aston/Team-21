<?php

namespace Database\Factories;

use App\Models\SupplierOrder;
use App\Models\SupplierOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierOrderFactory extends Factory
{
    protected $model = SupplierOrder::class;

    public function definition()
    {
        return [
            'supplier_name' => $this->faker->company,  // Generate random company name
            'total_amount' => $this->faker->randomFloat(2, 100, 1000),  // Random amount between 100 and 1000
            'order_date' => $this->faker->date(),  // Random date
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a SupplierOrder with items.
     *
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withItems($count = 1)
    {
        return $this->has(SupplierOrderItem::factory()->count($count), 'supplierOrderItems');
    }
}