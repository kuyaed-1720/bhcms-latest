<?php
namespace App\Actions;

use App\Models\User;
use Carbon\Carbon;

class GetActiveUsers
{
    /**
     * Get the count of active users based on the provided period.
     */
    public function execute()
    {
        $activeToday = User::whereDate('last_activity', Carbon::today())->count();

        $activeThisWeek = User::whereBetween('last_activity', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        $activeThisMonth = User::whereMonth('last_activity', Carbon::now()->month)
            ->whereYear('last_activity', Carbon::now()->year)
            ->count();

        return [
            'today' => $activeToday,
            'thisWeek' => $activeThisWeek,
            'thisMonth' => $activeThisMonth,
        ];
    }
}
