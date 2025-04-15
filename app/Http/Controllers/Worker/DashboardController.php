<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\LaundryLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Display the worker dashboard.
     */
    public function index(): View
    {
        $laundryCount = LaundryLog::count();
        $laundryLogs = LaundryLog::latest()->get();

        return view('worker.dashboard', compact('laundryCount', 'laundryLogs'));
    }

    /**
     * Store a newly created laundry log.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time_started' => 'required',
            'person_responsible' => 'required|string|max:255',
            'items_washed' => 'required|string|max:255',
            'quantity_items' => 'required|integer|min:1',
            'how_many_kilo' => 'required|numeric|min:0',
            'machine_used' => 'required|string|max:255',
            'detergent_used' => 'required|string|max:255',
            'how_many_detergent_used' => 'required|numeric|min:0',
            'drying_method' => 'required|string|max:255',
            'payment' => 'required|numeric|min:0',
        ]);

        LaundryLog::create($validated);

        return redirect()->route('worker.dashboard')
            ->with('success', 'Laundry log created successfully.');
    }
} 