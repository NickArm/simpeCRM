<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\services;

class ServicetoCustomer extends Controller
{
    public function store(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $service_id = $request->input('service_id');
        $price = $request->input('price');
        $expiration = $request->input('expiration');
       
        if ($request->input('reminder')){
            $reminder = 1;
        }else{
            $reminder = 0;
        }

        if ($request->input('paid_status')){
            $paid_status = 1;
        }else{
            $paid_status = 0;
        }
        $notes = $request->input('notes');
    
       $insert = DB::table('servicetocustomer')->insertGetId(['customer_id'=>$customer_id,'service_id'=>$service_id, 'price'=> $price, 'expiration' => $expiration, 'reminder'=>$reminder, 'paid_status'=> $paid_status,'notes'=>$notes ]);
        dd($insert );
       return redirect ('/customer_edit/'.$customer_id)->with('success','Service Added');
    }
}


