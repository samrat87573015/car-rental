<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'samrat2880@gmail.com',
            'phone' => '01887573015',
            'address' => 'Kushtia, Bangladesh',
            'password' => '12345678',
            'role' => 'admin'
        ]);
    }
}
