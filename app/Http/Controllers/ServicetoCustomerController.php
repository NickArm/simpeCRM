<?php

namespace App\Http\Controllers;

use App\Models\ServicetoCustomer;
use App\Models\ServicetoCustomerRecord;
use App\Services\RenewalService;
use Illuminate\Http\Request;

class ServicetoCustomerController extends Controller
{
    protected $renewalService;

    public function __construct(RenewalService $renewalService)
    {
        $this->renewalService = $renewalService;
    }

    public function renewService(Request $request, $servicetocustomerId)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:servicetocustomer,id',
            'new_price' => 'required|numeric',
            'new_expiration_date' => 'required|date',
        ]);

        // Begin database transaction
        \DB::beginTransaction();

        try {
            $serviceToCustomer = ServicetoCustomer::findOrFail($validated['service_id']);

            $isPaid = $serviceToCustomer->payment_id !== null;

            $serviceRecordData = [
                'servicetocustomer_id' => $serviceToCustomer->id,
                'start_date' => $serviceToCustomer->created_at,
                'end_date' => $serviceToCustomer->expiration,
                'is_paid' => $isPaid,
                'payment_id' => $isPaid ? $serviceToCustomer->payment_id : null,
            ];

            ServicetoCustomerRecord::create($serviceRecordData);

            $serviceToCustomer->price = $validated['new_price'];
            $serviceToCustomer->expiration = $validated['new_expiration_date'];
            $serviceToCustomer->payment_id = null; // Set payment_id to null to indicate it's not paid
            $serviceToCustomer->save();

            \DB::commit();

            return back()->with('success', 'Service renewed successfully.');
        } catch (\Exception $e) {
            \DB::rollback();

            return back()->with('error', 'Failed to renew the service: '.$e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric',
            'expiration' => 'required|date',
            'reminder' => 'sometimes|boolean',
            'notes' => 'nullable|string',
        ]);

        $validatedData['reminder'] = $request->has('reminder');

        // Remove the payment_id validation as it's not supposed to be part of the request
        // The payment_id will be associated when a payment is made

        $serviceToCustomer = ServicetoCustomer::create($validatedData);

        return redirect()->route('customer_edit', ['id' => $validatedData['customer_id']])
            ->with('success', 'Service Added');
    }

    public function edit($servicetocustomerId)
    {
        $servicetocustomer = ServicetoCustomer::findOrFail($servicetocustomerId);

        return response()->json($servicetocustomer);
    }

    public function update(Request $request, ServicetoCustomer $servicetocustomer)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric',
        ]);

        $servicetocustomer->update($validatedData);

        return redirect()->route('customer_edit', ['id' => $servicetocustomer->customer_id])
            ->with('success', 'Service to customer updated successfully.');

    }

    public function delete_service_from_user(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:servicetocustomer,id',
        ]);

        $serviceToCustomer = ServicetoCustomer::where('customer_id', $validatedData['customer_id'])
            ->where('id', $validatedData['service_id'])
            ->firstOrFail();

        if ($serviceToCustomer->paid_status && ! $serviceToCustomer->reminder) {
            $serviceToCustomer->delete();

            return back()->with('success', 'Service removed from customer.');
        } else {
            return back()->with('error', 'Service cannot be removed. All associated services must be paid and without reminders.');
        }
    }

    public function updateReminderStatus(Request $request)
    {
        $serviceToCustomer = ServicetoCustomer::findOrFail($request->id);
        $serviceToCustomer->reminder = $request->reminder;
        $serviceToCustomer->save();

        return response()->json(['message' => 'Reminder status updated successfully.']);
    }

    public function destroy($id)
    {
        $servicetocustomer = ServicetoCustomer::findOrFail($id);
        $servicetocustomer->delete();

        return redirect()->back()->with('success', 'Service removed from customer.');
    }
}
