<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\LaundryLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the client dashboard.
     */
    public function index(): View
    {
        $clientId = Auth::id();
        $laundryCount = LaundryLog::where('client_id', $clientId)->count();
        $totalPayment = LaundryLog::where('client_id', $clientId)->sum('payment');

        return view('client.dashboard', compact('laundryCount', 'totalPayment'));
    }
} 