<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\DB;


class ServiceExpirationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:ServiceExpirationReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

     public function __construct()
    {
        parent::__construct();
    }  
    public function handle()
    {
        
        $services = DB::table('servicetocustomer')
        ->join('customers', 'customers.id', '=', 'servicetocustomer.customer_id')
        ->where('reminder', '=', '1')
        ->select('servicetocustomer.*', 'customers.*')
        ->get();

        foreach($services as $s){
            

            if ($s->expiration == date("Y-m-d", strtotime("-30 days")))
            {
                //var_dump($s);
                echo "30 days expiration";  
                $data = [
                    'email' =>  $s->email,
                    'your_message'=>'Your sevice expire in 30 days',
                ];
                Mail::to($s->email)->send(new SendMail($data));


            }elseif ($s->expiration == date("Y-m-d", strtotime("-15 days"))){
                echo "15 days expiration";
                $data = [
                    'email' =>  $s->email,
                    'your_message'=>'Your sevice expire in 15 days',
                ];
                Mail::to($s->email)->send(new SendMail($data));
            }elseif ($s->expiration == date("Y-m-d", strtotime("-5 days"))){
                echo "5 days expiration";
                $data = [
                    'email' =>  $s->email,
                    'your_message'=>'Your sevice expire in 5 days',
                ];
                Mail::to($s->email)->send(new SendMail($data));
            }elseif ($s->expiration == date("Y-m-d")){
                echo "today expiration";
                $data = [
                    'email' =>  $s->email,
                    'your_message'=>'Your sevice expire TODAY',
                ];
                Mail::to($s->email)->send(new SendMail($data));
            }

        }
        //var_dump($services);

       echo date("Y-m-d", strtotime("-30 days")) ;
       //2022-12-25
    }
}