<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
  //
  use HasFactory;

  protected $table = 'orders';
  protected $primaryKey = 'order_id';

  protected $fillable = [
    'user_id',
    'order_date',
    'order_status',
    'total_amount'
  ];


  public function orderItems()
  {
    return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
