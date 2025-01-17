<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'health_worker'],
            ['id' => 3, 'name' => 'patient'],
        ]);
    }
}
