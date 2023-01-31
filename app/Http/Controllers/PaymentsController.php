<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
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
