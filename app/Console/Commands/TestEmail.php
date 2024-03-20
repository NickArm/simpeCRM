<?php

namespace App\Console\Commands;

use App\Mail\SendEmail;
use Illuminate\Console\Command; // Make sure to use the facade correctly
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:sendtest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a test email using the SendEmail mailable.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to('armenisnick@gmail.com')->send(new SendEmail());

        $this->info('Test email sent successfully.');

        return Command::SUCCESS;
    }
}
