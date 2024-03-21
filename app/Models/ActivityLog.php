<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'loggable_type', 'loggable_id', 'user_id', 'action', 'changes', 'ip_address',
    ];
}
