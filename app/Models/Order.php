<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'shipping_address',
    ];

    // Relasi: order dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: order punya banyak order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
