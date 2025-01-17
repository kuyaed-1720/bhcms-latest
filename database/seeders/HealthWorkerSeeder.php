<?php

namespace Database\Seeders;

use App\Models\HealthWorker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthWorker::create([
            'user_id' => 2,
            'start_term' => now(),
            'end_term' => null,
        ]);
    }
}
