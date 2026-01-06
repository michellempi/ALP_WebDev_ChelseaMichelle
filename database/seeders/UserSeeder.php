<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'phone' => '+1234567890',
                'address' => '123 Admin Street, Admin City, AC 12345',
                'role_id' => 1, // admin role
            ]
        );

        User::updateOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password'),
                'phone' => '+1987654321',
                'address' => '456 User Avenue, User Town, UT 67890',
                'role_id' => 2,
            ]
        );
    }
}
