<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'role_id' => 1, // Admin role
                'first_name' => 'Admin',
                'middle_name' => 'A',
                'last_name' => 'User',
                'birthday' => '1990-01-01',
                'age' => 34,
                'phone_number' => '+639123456789',
                'province' => 'Albay',
                'city' => 'Legazpi City',
                'barangay' => 'Homapon',
                'purok_id' => 1,
                'email' => 'admin@example.com',
                'password' => Hash::make(11111111),
            ],
            [
                'role_id' => 2, // Health Worker role
                'first_name' => 'Health',
                'middle_name' => 'H',
                'last_name' => 'Worker',
                'birthday' => '1985-06-15',
                'age' => 39,
                'phone_number' => '+639123456789',
                'province' => 'Albay',
                'city' => 'Legazpi City',
                'barangay' => 'Homapon',
                'purok_id' => 2,
                'email' => 'healthworker@example.com',
                'password' => Hash::make(11111111),
            ],
            [
                'role_id' => 3, // Patient role
                'first_name' => 'Patient',
                'middle_name' => 'P',
                'last_name' => 'User',
                'birthday' => '1995-07-20',
                'age' => 29,
                'phone_number' => '+639123456789',
                'province' => 'Albay',
                'city' => 'Legazpi City',
                'barangay' => 'Homapon',
                'purok_id' => 3,
                'email' => 'patient@example.com',
                'password' => Hash::make(11111111),
            ],
        ]);
    }
}
