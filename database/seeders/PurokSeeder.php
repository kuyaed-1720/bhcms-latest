<?php

namespace Database\Seeders;

use App\Models\Purok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purok::insert([
            ['id' => 1, 'name' => '1'],
            ['id' => 2, 'name' => '2'],
            ['id' => 3, 'name' => '3'],
            ['id' => 4, 'name' => '4'],
            ['id' => 5, 'name' => '5A'],
            ['id' => 6, 'name' => '5B'],
            ['id' => 7, 'name' => '6'],
            ['id' => 8, 'name' => '7'],
            ['id' => 9, 'name' => '8'],
            ['id' => 10, 'name' => '9'],
            ['id' => 11, 'name' => '10'],
            ['id' => 12, 'name' => '11'],
            ['id' => 13, 'name' => '12'],
        ]);
    }
}
