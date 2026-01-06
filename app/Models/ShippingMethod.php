<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shippingMethods';

    protected $primaryKey = 'shipping_method_id';

    protected $fillable = ['name', 'description', 'cost'];

    protected $casts = [
        'cost' => 'decimal:2',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_method_id', 'shipping_method_id');
    }
}
