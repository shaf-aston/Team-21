<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierOrder extends Model
{
  //
  use HasFactory;

  protected $table = 'supplier_orders';
  protected $primaryKey = 'id';

  protected $fillable = [
    'supplier_name',
    'total_amount',
    'order_date',
  ];

  public function supplierOrderItems()
  {
    return $this->hasMany(SupplierOrderItem::class, 'supplier_order_id', 'id');
  }
}
