<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicetoCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'service_id', 'price', 'expiration', 'reminder', 'payment_id', 'notes'];

    protected $table = 'servicetocustomer';

    protected $casts = [
        'expiration' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function records()
    {
        return $this->hasMany(ServicetoCustomerRecord::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
