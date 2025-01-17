<?php
namespace App\Actions;

use App\Models\Appointment;
use Carbon\Carbon;

class GetAppointmentsThisWeek
{
    /**
     * Get the count of active users based on the provided period.
     */
    public function execute()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $count = Appointment::whereBetween('appointment_date', [$startOfMonth, $endOfMonth])->count();
        
        return $count;
    }
}
