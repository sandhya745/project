@extends('layouts.admin')

@section('title', 'Help / Documentation')

@section('content')
    <div class="p-6 space-y-6">
        <div class="flex min-h-screen bg-slate-100">


            <div>
                <div>
                <h1 class=" text-3xl font-bold">Help / Documentation</h1>
                <p class="text-pink-600 mt-2">
                    Welcome to the admin dashboard help page! Here you can find guides, tips, and instructions for managing
                    the system.
                </p>
               </div>
                <!-- Section: Getting Started -->
                <div class="bg-white p-4 rounded-lg shadow space-m-2">
                    <h2 class="text-2xl font-semibold">Getting Started</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>After logging in, you are directed to the dashboard showing quick stats: total books, genres,
                            authors, and readers.</li>
                        <li>Use the sidebar to navigate through sections: Books, Genres, Authors, Users, Reports, Settings,
                            Notifications.</li>
                        <li>Click your profile at the top-right to view or edit your information, or to logout.</li>
                    </ul>
                </div>

                <!-- Section: Managing Content -->
                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                    <h2 class="text-2xl font-semibold">Managing Content</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li><strong>Books:</strong> Add new books, edit existing books, or delete books.</li>
                        <li><strong>Genres:</strong> Manage genres to categorize your books.</li>
                        <li><strong>Authors:</strong> Add authors, update their info, or remove them.</li>
                    </ul>
                </div>

                <!-- Section: Users & Readers -->
                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                    <h2 class="text-2xl font-semibold">Users & Readers</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>View all registered readers from the <strong>Users → Readers</strong> page.</li>
                        <li>Manage reader accounts: deactivate or contact them if needed.</li>
                    </ul>
                </div>

                <!-- Section: Reports & Analytics -->
                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                    <h2 class="text-2xl font-semibold">Reports & Analytics</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>Access analytics reports from <strong>Reports → Analytics</strong>.</li>
                        <li>View book trends, most active readers, and other statistics.</li>
                    </ul>
                </div>

                <!-- Section: Settings -->
                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                    <h2 class="text-2xl font-semibold">Settings</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>Update site settings under <strong>Settings → Site</strong>.</li>
                        <li>Backup or restore your database under <strong>Settings → Backup</strong>.</li>
                        <li>Manage newsletters and emails under <strong>Settings → Newsletter</strong>.</li>
                        <li>Update your admin profile under <strong>Settings → Profile</strong>.</li>
                    </ul>
                </div>

                <!-- Section: Help & Support -->
                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                    <h2 class="text-2xl font-semibold">Need More Help?</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>Check this help page regularly for updates.</li>
                        <li>For technical issues, contact your developer or IT support.</li>
                        <li>Common fixes:
                            <ul class="list-disc list-inside ml-4">
                                <li>If a page shows an error, run: <code>php artisan view:clear</code></li>
                                <li>To clear cache: <code>php artisan cache:clear</code></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
