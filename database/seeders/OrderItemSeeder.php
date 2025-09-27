<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Isi untuk Order id = 1 (pending)
        OrderItem::create([
            'order_id' => 1,
            'product_id' => 2, // Smartphone
            'quantity' => 1,
            'price' => 5000000,
        ]);

        // Isi untuk Order id = 2 (completed)
        OrderItem::create([
            'order_id' => 2,
            'product_id' => 1, // Laptop Gaming
            'quantity' => 1,
            'price' => 15000000,
        ]);
    }
}
