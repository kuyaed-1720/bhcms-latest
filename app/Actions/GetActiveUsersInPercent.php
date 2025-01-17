<?php
namespace App\Actions;

use App\Actions\GetActiveUsers;

class GetActiveUsersInPercent
{
    
    protected $getTotalUsers;
    protected $getActiveUsers;

    public function __construct(GetTotalUsers $getTotalUsers, GetActiveUsers $getActiveUsers)
    {
        $this->getTotalUsers = $getTotalUsers;
        $this->getActiveUsers = $getActiveUsers;
    }

    public function execute()
    {
        $totalUsers = $this->getTotalUsers->execute();
        $activeUsers = $this->getActiveUsers->execute();

        $activeTodayInPercent = round($activeUsers['today'] / $totalUsers * 100);
        $activeThisWeekInPercent = round($activeUsers['thisWeek'] / $totalUsers * 100);
        $activeThisMonthInPercent = round($activeUsers['thisMonth'] / $totalUsers * 100);
        return [
            'today' => $activeTodayInPercent,
            'thisWeek' => $activeThisWeekInPercent,
            'thisMonth' => $activeThisMonthInPercent,
        ];
    }
}
