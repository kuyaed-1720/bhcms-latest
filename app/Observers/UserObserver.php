<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Patient;
use App\Models\HealthWorker;
use App\Models\Admin;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class UserObserver implements ShouldHandleEventsAfterCommit 
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Check the role and insert corresponding data
        if ($user->role_id == 3) {
            Patient::create([
                'user_id' => $user->id,
            ]);
        } elseif ($user->role_id == 2) {
            HealthWorker::create([
                'user_id' => $user->id,
            ]);
        } elseif ($user->role_id == 1) {
            Admin::create([
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
