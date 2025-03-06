<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierOrderItem extends Model
{
    //
    use HasFactory;

    protected $table = 'supplier_order_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(SupplierOrder::class, 'supplier_order_id', 'id');
    }
}
