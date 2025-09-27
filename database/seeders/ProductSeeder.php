<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Gaming',
            'description' => 'Laptop kencang untuk gaming',
            'price' => 15000000,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Smartphone terbaru dengan kamera canggih',
            'price' => 5000000,
            'stock' => 25,
        ]);
    }
}
