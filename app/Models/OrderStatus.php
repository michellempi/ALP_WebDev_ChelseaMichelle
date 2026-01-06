<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'orderStatus';
    protected $primaryKey = 'orderStatus_id';
    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'orderStatus_id', 'orderStatus_id');
    }
}
