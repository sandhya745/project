<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function site()
    {
        // Example: you can add site settings logic here
        return view('admin.settings.site');
    }

    public function backup()
    {
        // Example: you can add backup / restore logic here
        return view('admin.settings.backup');
    }

    public function newsletter()
    {
        // Example: you can add newsletter logic here
        return view('admin.settings.newsletter');
    }

    public function profile()
    {
        // Example: you can add profile edit logic here
        return view('admin.settings.profile');
    }
}
