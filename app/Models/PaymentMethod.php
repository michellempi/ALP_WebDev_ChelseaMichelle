<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'paymentMethods';

    protected $primaryKey = 'payment_method_id';

    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_method_id', 'payment_method_id');
    }
}
