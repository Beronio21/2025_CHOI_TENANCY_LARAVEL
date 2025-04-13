<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the client dashboard.
     */
    public function index(): View
    {
        return view('client.dashboard');
    }
} 