@extends('layouts.admin')

@section('title','Site Settings')

@section('content')

        <!--setting content-->
<div class="flex justify-start items-middle mb-6  bg-white p-4 rounded-xl shadow">
    <!-- Sidebar -->
        <aside class="w-64 bg-slate-800 text-slate-200 shadow-xl min-h-screen p-4">
            <div class="text-xl font-bold text-white mb-6">Duskhub Admin</div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center">Home</a>

                <!-- Admin Menu -->
                <div x-data="{ open: true }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center">
                        <span>Admin</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('books.index') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Books</a>
                        <a href="{{ route('authors.index') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Authors</a>
                        <a href="{{ route('genres.index') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Genres</a>
                    </div>
                </div>

                <!-- Users Menu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Users</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('users.readers') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Readers</a>
                    </div>
                </div>

                <!-- Reports Menu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Reports</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('reports.analytics') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Analytics</a>
                    </div>
                </div>

                <!-- Notifications / Logs -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Notifications</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('notifications.logs') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Logs</a>
                    </div>
                </div>

                <!-- Settings Menu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Settings</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('settings.site') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Site Settings</a>
                        <a href="{{ route('settings.backup') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Backup / Restore</a>
                        <a href="{{ route('settings.newsletter') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Newsletter / Email</a>
                        <a href="{{ route('profile.show') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Profile</a>
                    </div>
                </div>

                <!-- Help / Documentation -->
                <a href="{{ route('help') }}" class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition mt-2">Help /
                    Documentation</a>

            </nav>
        </aside>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div>
         <h1 class="text-2xl font-bold mb-4">Site Settings</h1>

    <form action="{{ route('settings.updateSite') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Site Name</label>
            <input type="text" name="site_name" value="{{ $settings->site_name ?? '' }}" class="border rounded p-2 w-full">
        </div>

        <div>
            <label class="block font-medium">Site Email</label>
            <input type="email" name="site_email" value="{{ $settings->site_email ?? '' }}" class="border rounded p-2 w-full">
        </div>

        <div>
            <label class="block font-medium">Site Description</label>
            <textarea name="site_description" class="border rounded p-2 w-full">{{ $settings->site_description ?? '' }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Logo</label>
            @if(isset($settings->logo))
                <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="h-16 mb-2">
            @endif
            <input type="file" name="logo" class="border rounded p-2 w-full">
        </div>

        <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">Save Settings</button>
    </form>
    </div>
</div>
@endsection
