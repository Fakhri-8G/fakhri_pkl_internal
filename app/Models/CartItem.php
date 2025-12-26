<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    protected $appends = ['subtotal'];
    // Hitung subtotal item 

    public function getSubtotalAttribute()
    {
        if ($this->product->discount_price) {
            return $this->quantity * $this->product->discount_price;
        } 
    
        return $this->quantity * $this->product->price;
    }

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
