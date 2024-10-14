<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat user test menggunakan factory
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Memanggil CategorySeeder
        $this->call([
            CategorySeeder::class,
        ]);
    }
}