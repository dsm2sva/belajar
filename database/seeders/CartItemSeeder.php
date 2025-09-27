<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CartItem;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User id = 2 (User Satu) masukkan Laptop Gaming ke keranjang
        CartItem::create([
            'user_id' => 2,
            'product_id' => 1, // Laptop Gaming
            'quantity' => 1,
        ]);

        // User id = 2 (User Satu) masukkan Smartphone ke keranjang
        CartItem::create([
            'user_id' => 2,
            'product_id' => 2, // Smartphone
            'quantity' => 2,
        ]);
    }
}
