<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\customers;
use App\Models\services;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index',[ 'customers'=>Customers::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $company = $request->input('company');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
    
       $insert = DB::table('customers')->insertGetId(['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone,'address'=>$address,'company'=>$company ]);

    //Customer::create( $attributes);
       return redirect ('/customers')->with('success','New Customer Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $cus = Customers::where('id', $id)->firstOrFail();
        $services = DB::table('servicetocustomer')
        ->join('services', 'services.id', '=', 'servicetocustomer.service_id')
        ->where('servicetocustomer.customer_id', '=', $id)
        ->select('servicetocustomer.*', 'services.name as service_name')
        ->get();


        return view('customers.single',compact('cus','services'));
    }

    public function sendmessage(Request $request)
    {
        //dd($request);
        $data = [
            'email' =>  $request->email,
            'your_message'=>$request->your_message,
        ];

        Mail::to($request->email)->send(new SendMail($data));

        //dd('Success! Email has been sent successfully.');
     
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(customers $customers)
    {
        //
    }
}
