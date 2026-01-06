<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $primaryKey = 'promo_id';

    protected $fillable = ['name', 'start_time', 'end_time', 'discount'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'discount' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('start_time', '<=', now())
                    ->where('end_time', '>=', now());
    }

    public function getIsActiveAttribute()
    {
        return $this->start_time <= now() && $this->end_time >= now();
    }
}
