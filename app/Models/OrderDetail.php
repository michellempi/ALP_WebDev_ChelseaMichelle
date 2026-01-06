<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderDetails';
    protected $primaryKey = 'order_detail_id';

    protected $fillable = [
        'order_id',
        'variant_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
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
