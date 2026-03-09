<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Dusk_Translations')</title>
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
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- 🔹 ADMIN NAVIGATION -->
    <nav class="bg-white shadow-md mb-6">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo / Admin Title -->
            <h1 class="text-xl font-bold text-gray-800">📚 Dusk_Translations Admin</h1>

            <!-- Desktop Menu -->
            <div class="hidden md:flex gap-6 text-gray-700 font-medium">
                <a href="{{ route('books.index') }}" class="text-purple-400 hover:text-blue-600 transition">Books</a>
                <a href="{{ route('genres.index') }}" class="text-green-400 hover:text-blue-600 transition">Genres</a>
                <a href="{{ route('authors.index') }}" class="text-red-400 hover:text-blue-600 transition">Authors</a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>

            </div>

            <!-- Mobile Hamburger Menu -->
            <div class="md:hidden relative">
                <button @click="open = !open" class="text-2xl text-gray-700 focus:outline-none">☰</button>

                <div x-show="open" x-transition @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white border shadow-md rounded-md z-50" style="display: none;">
                    <div class="flex flex-col px-4 py-3 space-y-2">
                        <a href="{{ url('/') }}" class="hover:text-blue-600">🏠 Home</a>
                        <a href="{{ route('books.index') }}" class="hover:text-purple-600">📖 Books</a>
                        <a href="{{ route('genres.index') }}" class="hover:text-green-600">🎭 Genres</a>
                        <a href="{{ route('authors.index') }}" class="hover:text-red-600">🖊️ Authors</a>
                        <a href="#" class="hover:text-gray-600">⚙️ Settings</a>
                    </div>
                </div>
            </div>

        </div>
    </nav>
    <!-- 🔹 END NAVIGATION -->

    <div class="container mx-auto px-4 py-6">
        @yield('content') <!-- Your admin page content -->
    </div>
</body>

</html>
