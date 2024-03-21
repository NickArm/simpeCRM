<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicetoCustomer extends Model
{
    protected static function booted()
    {
        static::created(function ($model) {
            ActivityLog::create([
                'loggable_type' => get_class($model),
                'loggable_id' => $model->id,
                'action' => 'created',
                'changes' => json_encode($model->getChanges()),
                'ip_address' => request()->ip(),
            ]);
        });

        static::updated(function ($model) {
            ActivityLog::create([
                'loggable_type' => get_class($model),
                'loggable_id' => $model->id,
                'action' => 'updated',
                'changes' => json_encode($model->getChanges()),
                'ip_address' => request()->ip(),
            ]);
        });
    }

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
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
