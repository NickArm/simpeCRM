<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        $payments = DB::table('payments')
        ->join('servicetocustomer', 'servicetocustomer.id', '=', 'payments.servicetocustomer_id')
        ->join('services', 'services.id', '=', 'servicetocustomer.service_id')
        ->join('customers', 'customers.id', '=', 'payments.customer_id')
        ->select('payments.*','services.name as servname','customers.fname as cusfname','customers.lname as cuslname')
        ->get();


        return view('payments.index',compact('payments'));
    }

    public function store(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $servicetocustomer_id = $request->input('servicetocustomer_id');
        $custom_service = $request->input('custom_service');
        $price = $request->input('price');
        $payment_date = $request->input('payment_date');
        $payment_type = $request->input('payment_type');
        $notes = $request->input('notes');
     
    
       $insert = DB::table('payments')->insertGetId(['customer_id'=>$customer_id,'servicetocustomer_id'=>$servicetocustomer_id ,
       'custom_service'=>$custom_service,'price'=>$price,'payment_date'=>$payment_date,'payment_type'=>$payment_type,'notes'=>$notes]);
       return redirect ('/customer_edit/'.$customer_id);
    }
}
