<?php
namespace App\Actions;

use App\Models\Appointment;

class GetTotalAppointments
{
    public function execute()
    {
        return Appointment::count();
    }
}
