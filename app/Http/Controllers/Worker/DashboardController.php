<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\LaundryLog;

class DashboardController extends Controller
{
    /**
     * Display the worker dashboard.
     */
    public function index(): View
    {
        $laundryCount = LaundryLog::count();

        return view('worker.dashboard', compact('laundryCount'));
    }
} 