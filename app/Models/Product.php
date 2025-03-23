<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;



    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'stock_quantity',
        'img_id',
        'category_id',
        'updated_at',
        'created_at',
        'popularityranking',
        'brand',
        'colour',
        'ram',
    ];

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id', 'product_id');

    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishListItem::class, 'product_id', 'product_id');
    }

    // Automatically delete related wishlist items when a product is deleted
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->wishlistItems()->delete();
        });
    }

    


    
}