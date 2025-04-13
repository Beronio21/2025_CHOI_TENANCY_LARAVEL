<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use App\Models\LaundryLog;

class DashboardController extends Controller
{
    /**
     * Display the landlord dashboard.
     */
    public function index(): View
    {
        $workerCount = User::where('role', 'worker')->count();
        $clientCount = User::where('role', 'client')->count();
        $laundryCount = LaundryLog::count();
        $totalEarnings = LaundryLog::sum('payment');

        return view('landlord.dashboard', compact('workerCount', 'clientCount', 'laundryCount', 'totalEarnings'));
    }
} 