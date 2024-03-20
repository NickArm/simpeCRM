<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicetoCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function index()
    {
        return view('services.index', ['services' => Service::all()]);
    }

    public static function count_each_service($id)
    {
        $sc = ServicetoCustomer::where('service_id', $id)->count();

        return $sc;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $insert = DB::table('services')->insertGetId(['name' => $name, 'description' => $description]);

        return redirect('/services')->with('success', 'New Service Added');
    }

    public static function show()
    {
        $services = Service::all();

        return $services;
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validatedData);

        return redirect('/services')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::with('servicetocustomers')->findOrFail($id);

        // Check if all servicetocustomers related to this service are paid and have no reminders
        $canDelete = $service->servicetocustomers->every(function ($servicetocustomer) {
            return $servicetocustomer->paid_status && ! $servicetocustomer->reminder;
        });

        if ($canDelete) {
            $service->delete();

            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } else {
            return back()->with('error', 'Service cannot be deleted because there are unpaid or reminded servicetocustomers.');
        }
    }
}
