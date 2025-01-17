<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Purok;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create()
    {
        $puroks = Purok::all();
        return Inertia::render('Auth/Register', [
            'jetstream' => config('jetstream'),
            'auth' => ['user' => Auth::user()],
            'puroks' => $puroks,
        ]);
    }
}