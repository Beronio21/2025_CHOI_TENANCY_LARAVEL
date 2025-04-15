<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;

class PaymentRecordController extends Controller
{
    public function index()
    {
        $paymentRecords = PaymentRecord::all();
        return view('landlord.payment_records', compact('paymentRecords'));
    }

    public function create()
    {
        return view('landlord.payment_records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => 'required',
            'customer' => 'required',
            'wash_id' => 'required',
            'kilos' => 'required|numeric',
            'rate_per_kg' => 'required|numeric',
            'detergent_fee' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_status' => 'required'
        ]);

        PaymentRecord::create($validated);

        return redirect()->route('landlord.payment_records.index');
    }

    public function edit(PaymentRecord $paymentRecord)
    {
        return view('landlord.payment_records.edit', compact('paymentRecord'));
    }

    public function update(Request $request, PaymentRecord $paymentRecord)
    {
        $validated = $request->validate([
            'payment_id' => 'required',
            'customer' => 'required',
            'wash_id' => 'required',
            'kilos' => 'required|numeric',
            'rate_per_kg' => 'required|numeric',
            'detergent_fee' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_status' => 'required'
        ]);

        $paymentRecord->update($validated);

        return redirect()->route('landlord.payment_records.index');
    }

    public function destroy(PaymentRecord $paymentRecord)
    {
        $paymentRecord->delete();

        return redirect()->route('landlord.payment_records.index');
    }
}
