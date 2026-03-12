<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic:wght@200&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playwrite NZ Basic', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen" x-data="{ open: false }">

    <!-- Admin Navigation -->
    <nav class="bg-white shadow-md mb-6">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">📚 Admin Panel</h1>

            <!-- Desktop menu -->
            <div class="hidden md:flex gap-6 items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-purple-500 hover:bg-indigo-100">Home</a>
                <a href="{{ route('books.index') }}" class="text-indigo-600 hover:text-indigo-800">Books</a>
                <a href="{{ route('genres.index') }}" class="text-green-600 hover:text-green-800">Genres</a>
                <a href="{{ route('authors.index') }}" class="text-red-600 hover:text-red-800">Authors</a>

                <!-- Profile Dropdown -->
                <div x-data="{ openProfile: false }" class="relative">
                    <button @click="openProfile = !openProfile"
                        class="text-purple-600 hover:text-purple-800 flex items-center gap-1">
                         <img src="https://via.placeholder.com/32" class="rounded-full">
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="openProfile" x-transition @click.away="openProfile = false"
                        class="absolute right-0 mt-2 w-48 bg-white border shadow-md rounded-md z-50"
                        style="display: none;">
                        <div class="flex flex-col py-2">
                            <a href="{{ route('profile.show') }}" class="px-4 py-2 hover:bg-gray-100">View Profile</a>
                            <a href="{{ route('profile.edit') }}" class="px-4 py-2 hover:bg-gray-100">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="md:hidden relative">
                <button @click="open = !open" class="text-2xl focus:outline-none">☰</button>
                <div x-show="open" x-transition @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white border shadow-md rounded-md z-50"
                    style="display: none;">
                    <div class="flex flex-col px-4 py-3 space-y-2">
                         <a href="{{ route('admin.dashboard') }}" class="text-purple-500 hover:bg-indigo-100">Home</a>
                        <a href="{{ route('books.index') }}" class="hover:text-indigo-600">📖 Books</a>
                        <a href="{{ route('genres.index') }}" class="hover:text-green-600">🎭 Genres</a>
                        <a href="{{ route('authors.index') }}" class="hover:text-red-600">🖊️ Authors</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-left text-red-500 hover:text-red-700">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <script src="//unpkg.com/alpinejs" defer></script>
    </nav>

    <!-- Main content -->
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>

</body>
</html>
