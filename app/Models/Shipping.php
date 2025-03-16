<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Shipping extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'shipping';
    protected $primaryKey = 'shipping_id';

    protected $fillable = [
        'order_id','shipping_address','shipping_status','shipping_date'	
    ];


}
