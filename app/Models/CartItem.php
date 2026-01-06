<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cartItems';
    protected $primaryKey = 'cart_item_id';
    protected $fillable = ['cart_id', 'variant_id', 'quantity', 'price'];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'variants_id');
    }

    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
