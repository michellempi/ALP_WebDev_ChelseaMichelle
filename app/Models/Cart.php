<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['user_id', 'total_amount'];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }

    public function calculateTotal()
    {
        $this->total_amount = $this->cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $this->save();
    }
}
