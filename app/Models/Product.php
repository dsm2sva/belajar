<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'sku',
    ];
    // Relasi: 1 produk bisa ada di banyak cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relasi: 1 produk bisa ada di banyak order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
