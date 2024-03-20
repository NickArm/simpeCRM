<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ServicetoCustomer;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::with('servicetocustomer.customer', 'servicetocustomer.service')->get();

        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'price' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_type' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $payment = Payment::create($validated);

        if ($request->filled('servicetocustomer_id')) {
            $servicetocustomer = ServicetoCustomer::findOrFail($request->input('servicetocustomer_id'));
            $servicetocustomer->payment_id = $payment->id;
            $servicetocustomer->save();
        }

        return redirect()->route('customer_edit', $validated['customer_id'])
            ->with('success', 'Payment added successfully.');
    }
}
