<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create([
            'name' => 'Produk A',
            'price' => 100000,
            'stock' => 50,
            'status' => 'Aktif',
            'image_url' => 'https://via.placeholder.com/150',
        ]);
    }
}