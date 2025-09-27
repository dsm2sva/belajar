<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Order pertama (pending)
        Order::create([
            'user_id' => 2,
            'status' => 'pending',
            'total' => 5000000, // 1 smartphone
        ]);

        // Order kedua (completed)
        Order::create([
            'user_id' => 2,
            'status' => 'completed',
            'total' => 15000000, // 1 laptop
        ]);
    }
}
