<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::all();

        return view('activity_log', compact('activityLogs'));
    }
}
