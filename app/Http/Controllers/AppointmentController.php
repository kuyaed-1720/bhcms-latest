<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Appointment;
// use App\Models\HealthWorker;
// use App\Models\Patient;
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
        $query = Appointment::paginate(5);

        // if ($user->role_id == 2) {
        //     $healthWorker = $user->healthWorker;
        //     if ($healthWorker) {
        //         $query->where('health_worker_id', $healthWorker->id);
        //     }
        // } elseif ($user->role_id == 3) {
        //     $patient = $user->patient;
        //     if ($patient) {
        //         $query->where('patient_id', $patient->id);
        //     }
        // }
        
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->input('status'));
        }

        $appointments = $query;

        // Get the items (appointments) from the current page
        $appointmentsData = $appointments->items(); 

        // Transform the appointments data
        $appointmentsData = collect($appointmentsData)->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'purpose' => $appointment->purpose,
                'appointment_date' => $appointment->appointment_date,
                // 'patient_name' => $appointment->patient->user->first_name . " " . $appointment->patient->user->last_name,
                // 'health_worker_name' => $appointment->healthWorker->user->first_name . " " . $appointment->healthWorker->user->last_name,
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
        // $users = User::all();
        // $healthworkers = $users->with('role_id', 2);
        $users = User::where('role_id', 2);

        return Inertia::render('Appointments/Create', [
            'user' => $user,
            // 'health_workers' => $healthworkers,
            // 'patients' => $patients,
            'users' => $users
        ]);
    }

    public function store (Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'purpose' => 'required|string|max:255',
            'appointment_date' => 'required|date|after_or_equal:today',
            // 'status' => 'required|in:pending,finished,cancelled',
        ]);

        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'purpose'=> $request->purpose,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        return redirect('/appointments');
    }
}
