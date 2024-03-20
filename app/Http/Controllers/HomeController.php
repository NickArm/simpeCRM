<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $services = Service::all();

        $customers = DB::table('servicetocustomer')
            ->join('services', 'services.id', '=', 'servicetocustomer.service_id')
            ->join('customers', 'customers.id', '=', 'servicetocustomer.customer_id')
            ->select('servicetocustomer.*', 'services.name as service_name', 'customers.id as customer_id', 'customers.fname as customer_fname', 'customers.lname as customer_lname')
            ->get();

        return view('welcome', compact('customers', 'services'));

    }

    public static function finance()
    {
        $earnings = DB::table('servicetocustomer')
            ->sum('price');

        $debts = DB::table('servicetocustomer')
            ->sum('price');

        $customers = Customer::count();

        $finance = [$earnings, $debts, $customers];

        return $finance;
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
