<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'name' => 'Admin User',
            'email' => 'admin@museum.local',
            'phone' => '09171234567',
            'role' => User::ROLE_ADMIN,
            'status' => User::STATUS_ACTIVE,
            'password' => Hash::make('password'),
            'last_login_at' => now(),
        ]);

        User::factory()->create([
            'first_name' => 'Staff',
            'last_name' => 'User',
            'name' => 'Staff User',
            'email' => 'staff@museum.local',
            'phone' => '09181234567',
            'role' => User::ROLE_STAFF,
            'status' => User::STATUS_ACTIVE,
            'password' => Hash::make('password'),
        ]);
    }
}
