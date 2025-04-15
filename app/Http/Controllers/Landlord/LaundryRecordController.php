<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaundryRecord;

class LaundryRecordController extends Controller
{
    public function index()
    {
        $laundryRecords = LaundryRecord::all();
        return view('landlord.laundry_records', compact('laundryRecords'));
    }

    public function create()
    {
        return view('landlord.laundry_records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wash_id' => 'required',
            'customer_name' => 'required',
            'item_name' => 'required',
            'qty' => 'required|integer',
            'kilos' => 'required|numeric',
            'detergent_type' => 'required',
            'detergent_used_g' => 'required|integer',
            'date_washed' => 'required|date',
            'status' => 'required'
        ]);

        LaundryRecord::create($validated);

        return redirect()->route('landlord.laundry_records.index');
    }

    public function edit(LaundryRecord $laundryRecord)
    {
        return view('landlord.laundry_records.edit', compact('laundryRecord'));
    }

    public function update(Request $request, LaundryRecord $laundryRecord)
    {
        $validated = $request->validate([
            'wash_id' => 'required',
            'customer_name' => 'required',
            'item_name' => 'required',
            'qty' => 'required|integer',
            'kilos' => 'required|numeric',
            'detergent_type' => 'required',
            'detergent_used_g' => 'required|integer',
            'date_washed' => 'required|date',
            'status' => 'required'
        ]);

        $laundryRecord->update($validated);

        return redirect()->route('landlord.laundry_records.index');
    }

    public function destroy(LaundryRecord $laundryRecord)
    {
        $laundryRecord->delete();

        return redirect()->route('landlord.laundry_records.index');
    }
}
