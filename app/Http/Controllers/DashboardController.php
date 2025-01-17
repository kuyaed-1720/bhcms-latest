<?php

namespace App\Http\Controllers;

use App\Actions\GetActiveUsers;
use App\Actions\GetActiveUsersInPercent;
use App\Http\Controllers\Controller;
use App\Actions\GetTotalUsers;
use App\Actions\GetTotalAppointments;
use App\Actions\GetAppointmentsThisWeek;

class DashboardController extends Controller
{
    protected $getTotalUsers;
    protected $getActiveUsers;
    protected $getActiveUsersInPercent;
    protected $getTotalAppointments;
    protected $getAppointmentsThisWeek;

    public function __construct(GetTotalUsers $getTotalUsers, GetActiveUsers $getActiveUsers, GetActiveUsersInPercent $getActiveUsersInPercent, GetTotalAppointments $getTotalAppointments, GetAppointmentsThisWeek $getAppointmentsThisWeek)
    {
        $this->getTotalUsers = $getTotalUsers;
        $this->getActiveUsers = $getActiveUsers;
        $this->getActiveUsersInPercent = $getActiveUsersInPercent;
        $this->getTotalAppointments = $getTotalAppointments;
        $this->getAppointmentsThisWeek = $getAppointmentsThisWeek;
    }

    public function index()
    {
        $totalUsers = $this->getTotalUsers->execute();
        $activeUsers = $this->getActiveUsers->execute();
        $activeUsersInPercent = $this->getActiveUsersInPercent->execute();
        $totalAppointments = $this->getTotalAppointments->execute();
        $appointmentsThisWeek = $this->getAppointmentsThisWeek->execute();

        return inertia('Dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'activeUsersInPercent' => $activeUsersInPercent,
            'totalAppointments' => $totalAppointments,
            'appointmentsThisWeek' => $appointmentsThisWeek
        ]);
    }
}
