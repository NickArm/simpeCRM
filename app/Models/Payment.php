<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'custom_service',
        'price', 'payment_date', 'payment_type', 'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function servicetocustomer()
    {
        return $this->belongsTo(ServicetoCustomer::class);
    }
}
