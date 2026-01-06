<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'address_book_id',
        'payment_method_id',
        'shipping_method_id',
        'order_status_id',
        'promo_id',
        'order_date',
        'order_time',
        'total_amount',
        'payment_proof',
    ];

    protected $casts = [
        'order_date' => 'date',
        'order_time' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function getRouteKeyName()
    {
        return 'order_id';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function addressBook()
    {
        return $this->belongsTo(AddressBook::class, 'address_book_id', 'address_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'shipping_method_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'orderStatus_id');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id', 'promo_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function getFormattedOrderDateTimeAttribute()
    {
        return $this->order_date->format('M j, Y') . ' at ' . $this->order_time->format('g:i A');
    }

    public function getStatusBadgeClassesAttribute()
    {
        return match($this->orderStatus->name) {
            'Pending' => 'bg-yellow-100 text-yellow-800',
            'Processing' => 'bg-blue-100 text-blue-800',
            'Shipped' => 'bg-indigo-100 text-indigo-800',
            'Delivered' => 'bg-green-100 text-green-800',
            'Cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
