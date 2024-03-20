<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicetoCustomerRecord extends Model
{
    protected $table = 'servicetocustomer_records';

    protected $fillable = [
        'servicetocustomer_id', 'start_date', 'end_date', 'is_paid', 'payment_id',
    ];

    public function servicetocustomer()
    {
        return $this->belongsTo(ServicetoCustomer::class);
    }
}
