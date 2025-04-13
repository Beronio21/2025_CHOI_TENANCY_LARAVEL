<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the worker dashboard.
     */
    public function index(): View
    {
        return view('worker.dashboard');
    }
} 