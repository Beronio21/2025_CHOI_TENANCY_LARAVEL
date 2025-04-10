<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaundryLog;

class LaundryLogController extends Controller
{
    /**
     * Display a listing of the laundry logs.
     */
    public function index()
    {
        $laundryLogs = LaundryLog::all();
        return view('admin.laundry_logs.index', compact('laundryLogs'));
    }

    public function create()
    {
        return view('admin.laundry_logs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time_started' => 'required',
            'person_responsible' => 'required|string',
            'items_washed' => 'required|string',
            'quantity_items' => 'required|integer',
            'how_many_kilo' => 'required|integer',
            'machine_used' => 'required|string',
            'detergent_used' => 'required|string',
            'how_many_detergent_used' => 'required|integer',
            'drying_method' => 'required|string',
        ]);

        LaundryLog::create($validatedData);

        return redirect()->route('admin.laundry_logs.index')->with('success', 'Laundry log created successfully.');
    }

    public function show($id)
    {
        $laundryLog = LaundryLog::findOrFail($id);
        return view('admin.laundry_logs.show', compact('laundryLog'));
    }

    public function edit($id)
    {
        $laundryLog = LaundryLog::findOrFail($id);
        return view('admin.laundry_logs.edit', compact('laundryLog'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time_started' => 'required',
            'person_responsible' => 'required|string',
            'items_washed' => 'required|string',
            'quantity_items' => 'required|integer',
            'how_many_kilo' => 'required|integer',
            'machine_used' => 'required|string',
            'detergent_used' => 'required|string',
            'how_many_detergent_used' => 'required|integer',
            'drying_method' => 'required|string',
        ]);

        $laundryLog = LaundryLog::findOrFail($id);
        $laundryLog->update($validatedData);

        return redirect()->route('admin.laundry_logs.index')->with('success', 'Laundry log updated successfully.');
    }

    public function destroy($id)
    {
        $laundryLog = LaundryLog::findOrFail($id);
        $laundryLog->delete();

        return redirect()->route('admin.laundry_logs.index')->with('success', 'Laundry log deleted successfully.');
    }

    // Additional methods for creating, storing, editing, updating, and deleting laundry logs can be added here
} 