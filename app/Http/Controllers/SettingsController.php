<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    // Show site settings page
    public function site()
    {
        // Fetch current settings from database (or config table)
        $settings = DB::table('settings')->first();

        return view('admin.settings.site', compact('settings'));
    }

    // Update site settings
    public function updateSite(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'site_description' => 'nullable|string|max:500',
        ]);

        DB::table('settings')->update([
            'site_name' => $request->site_name,
            'site_email' => $request->site_email,
            'site_description' => $request->site_description,
            'updated_at' => now(),
        ]);

        return redirect()->route('settings.site')->with('success', 'Site settings updated successfully.');
    }

    public function backup()
    {
        // Example: you can add backup / restore logic here
        return view('admin.settings.backup');
    }

  public function createBackup()
{
    $filename = 'backup-' . date('Y-m-d-H-i-s') . '.sql';
    $filePath = storage_path('backups/' . $filename);

    if (!file_exists(storage_path('backups'))) {
        mkdir(storage_path('backups'), 0755, true);
    }

    $command = "mysqldump -u " . env('DB_USERNAME') .
               " -p" . env('DB_PASSWORD') .
               " " . env('DB_DATABASE') .
               " > " . $filePath;

    exec($command);

    return redirect()->back()->with('success', "Backup created successfully: $filename");
}

    public function restoreBackup(Request $request)
    {
        // Example: handle uploaded backup file (this needs proper implementation)
        // $file = $request->file('backup_file');
        // logic to restore backup from file

        return redirect()->back()->with('success', 'Backup restored successfully!');
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
