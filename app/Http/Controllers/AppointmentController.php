<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\HealthWorker;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    
/**
 * @property string $role
 * @method bool isAdmin()
 * @method bool isHealthWorker()
 * @method bool isPatient()
 */

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Appointment::with(['patient.user', 'healthWorker.user']);

        if ($user->role_id == 2) {
            $healthWorker = $user->healthWorker;
            if ($healthWorker) {
                $query->where('health_worker_id', $healthWorker->id);
            }
        } elseif ($user->role_id == 3) {
            $patient = $user->patient;
            if ($patient) {
                $query->where('patient_id', $patient->id);
            }
        }
        
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->input('status'));
        }

        $appointments = $query->paginate(5);

        // Get the items (appointments) from the current page
        $appointmentsData = $appointments->items(); 

        // Transform the appointments data
        $appointmentsData = collect($appointmentsData)->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'description' => $appointment->description,
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
                'patient_name' => $appointment->patient->user->first_name . " " . $appointment->patient->user->last_name,
                'health_worker_name' => $appointment->healthWorker->user->first_name . " " . $appointment->healthWorker->user->last_name,
                'status' => $appointment->status,
                'total' => $appointment->count(),
            ];
        });

        return Inertia::render('Appointment', [
            'appointments' => $appointmentsData,
            'meta' => [
                'current_page' => $appointments->currentPage(),
                'last_page' => $appointments->lastPage(),
                'total' => $appointments->total(),
            ],
            'filters' => $request->only('status'),
            'user' => $user
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $users = User::all();
        $healthworkers = HealthWorker::all();
        $patients = Patient::all();

        return Inertia::render('Appointments/Create', [
            'user' => $user,
            'health_workers' => $healthworkers,
            'patients' => $patients,
            'users' => $users
        ]);
    }
}
