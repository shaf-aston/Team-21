<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Payments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'order_id','payment_date','amount_paid','payment_method','cardName','cardNumber','expirydate','cvv'	
    ];


}
