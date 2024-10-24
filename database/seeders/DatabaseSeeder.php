<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'phone' => '1234567890',
            'password' => bcrypt('secret'),
            'aadhar_no' => 'secret',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@material.com',
            'phone' => '1234567890',
            'password' => bcrypt('12345678'),
            'aadhar_no' => '123456789012',
            'role' => 'user'
        ]);
    }
}
