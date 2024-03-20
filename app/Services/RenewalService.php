<?php

namespace App\Services;

class RenewalService
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            (new RenewalService())->checkForServiceRenewals();
        })->daily();
    }

    public function handleRenewal($serviceToCustomerRecord)
    {
        // Your renewal logic here
    }
}
