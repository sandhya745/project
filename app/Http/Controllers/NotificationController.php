<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function logs()
    {
        // Example: you can fetch notifications from DB later
        $logs = [
            ['message' => 'New book added', 'date' => now()->subDays(1)],
            ['message' => 'User registered', 'date' => now()->subDays(2)],
            ['message' => 'Server backup completed', 'date' => now()->subDays(3)],
        ];

        return view('admin.notifications.logs', compact('logs'));
    }
}
