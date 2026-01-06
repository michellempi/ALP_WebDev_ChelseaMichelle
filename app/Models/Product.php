<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = ['name', 'description', 'image_url', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id', 'product_id');
    }

    public function getStockQuantityAttribute()
    {
        return $this->variants->sum('stock_quantity');
    }
}
