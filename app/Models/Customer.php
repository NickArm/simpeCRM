<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model // Conventionally, model names are singular
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            $customer->servicetocustomer()->delete();
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class); // Assuming the foreign key is customer_id
    }

    public function payments()
    {
        return $this->hasMany(Payment::class); // Assuming the foreign key is customer_id
    }

    public function servicetocustomer()
    {
        return $this->hasMany(ServicetoCustomer::class);
    }
}
