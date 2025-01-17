<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// AJ
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
});

Route::get('/test', [TestController::class, 'index']);
Route::post('/test', [TestController::class, 'store']);

Route::get('/register', [UserController::class, 'create'])->name('register');
