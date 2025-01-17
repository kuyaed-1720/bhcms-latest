<?php
namespace App\Actions;

use App\Models\User;

class GetTotalUsers
{
    public function execute()
    {
        return User::count();
    }
}
