<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the landlord dashboard.
     */
    public function index(): View
    {
        return view('landlord.dashboard');
    }
} 