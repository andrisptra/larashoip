<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate([
            'email' => 'admin@shop.com',
        ], [
            'name' => 'Admin Shop',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::firstOrCreate([
            'email' => 'pelanggan@shop.com',
        ], [
            'name' => 'Pelanggan',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);


        // seeder for categories
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Books']);
        Category::create(['name' => 'Clothing']);
    }
}
