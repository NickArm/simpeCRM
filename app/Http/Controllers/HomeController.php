<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\customers;
use App\Models\services;
use Illuminate\Http\Request;
use Session;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $services = Services::all();
        //$customers = Customers::all();

        $customers = DB::table('servicetocustomer')
        ->join('services', 'services.id', '=', 'servicetocustomer.service_id')
        ->join('customers', 'customers.id', '=', 'servicetocustomer.customer_id')
        ->select('servicetocustomer.*', 'services.name as service_name',  'customers.id as customer_id' ,'customers.fname as customer_fname', 'customers.lname as customer_lname')
        ->get();


        return view('welcome',compact('customers','services'));

    }

    public static function finance()
    {
        $earnings = DB::table('servicetocustomer')
        ->where('paid_status','=','1')
        ->sum('price');
        
        $debts = DB::table('servicetocustomer')
        ->where('paid_status','=','0')
        ->sum('price');

        $customers = Customers::count();

        $finance=[$earnings,$debts, $customers];

        return $finance;
        //dd($price);
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
