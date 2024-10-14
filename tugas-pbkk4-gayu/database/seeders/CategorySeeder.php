<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Tops',
            'Jumpers',
            'Jackets',
            'Bottoms',
            'Accessories'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}