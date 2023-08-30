<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(100)->create();

        User::create([
            'name' => 'Admin',
            'role' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('vasscomm2023'), // password
            'remember_token' => Str::random(10),
        ]);

    }
}
