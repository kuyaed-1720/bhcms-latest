<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\TestEvent;

class TestController extends Controller
{
    public function index()
    {

        return Inertia::render('Test/Test');
    }
}
