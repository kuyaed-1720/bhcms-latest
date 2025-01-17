<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\HealthWorker;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch all health workers and patients
        $healthWorkers = HealthWorker::all();
        $patients = Patient::all();

        // Ensure we have data to seed
        if ($healthWorkers->isEmpty() || $patients->isEmpty()) {
            $this->command->warn('No health workers or patients found. Skipping AppointmentSeeder.');
            return;
        }

        // Generate random appointments
        for ($i = 0; $i < 10; $i++) {
            $appointmentDate = Carbon::now()->subDays(rand(0, 30))->addDays(rand(0, 30));
            $appointmentTime = Carbon::createFromTime(rand(8, 17), rand(0, 59), 0);

            Appointment::create([
                'patient_id' => $patients->random()->id,
                'health_worker_id' => $healthWorkers->random()->id,
                'title' => 'Checkup',
                'description' => 'Routine appointment for patient health checkup.',
                'appointment_date' => $appointmentDate->toDateString(),
                'appointment_time' => $appointmentTime->toTimeString(),
                'status' => collect(['pending', 'confirmed', 'completed', 'cancelled'])->random(),
            ]);
        }

        $this->command->info('10 Appointments seeded successfully!');
    }
}
