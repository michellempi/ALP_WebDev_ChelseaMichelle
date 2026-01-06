<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    protected $table = 'addressBooks';
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'user_id',
        'receiver_name',
        'phone',
        'address_line',
        'city',
        'province',
        'postal_code',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'address_book_id', 'address_id');
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function getFullAddressAttribute()
    {
        return $this->address_line . ', ' . $this->city . ', ' . $this->province . ' ' . $this->postal_code;
    }
}
