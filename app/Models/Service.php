<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($service) {
            if ($service->servicetocustomer()->count() > 0) {
                throw new \Exception('Cannot delete service because it has associated customers.');
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, ServicetoCustomer::class);
    }

    public function servicetocustomers()
    {
        return $this->hasMany(ServicetoCustomer::class);
    }
}
