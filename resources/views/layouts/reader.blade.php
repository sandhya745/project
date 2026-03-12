<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dusk_Translations')</title>

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

<body class="bg-gray-50 min-h-screen">
<script src="//unpkg.com/alpinejs" defer></script>

<!-- 🔹 GLOBAL NAVIGATION -->
<nav class="bg-white shadow-md mb-6 px-6 py-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center">

        <!-- Logo -->
        <a href="{{ route('reader.index') }}" class="text-xl font-bold text-gray-800">
            📚 Dusk_Translations
        </a>

        <!-- Desktop Menu (visible on md+ screens) -->
        <div class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('reader.index') }}" class="hover:text-purple-600">🏠 </a>
            <a href="{{ route('reader.index') }}" class="hover:text-purple-600">📖 </a>
            <a href="{{ route('reader.genres') }}" class="hover:text-purple-600">📂</a>
            <a href="#" class="hover:text-purple-600">⚙ </a>

        </div>

        <!-- Mobile Hamburger Button (visible on small screens) -->
        <div class="md:hidden relative">
            <button @click="open = !open"
                    class="text-2xl text-gray-700 focus:outline-none">
                ☰
            </button>

            <!-- Dropdown Menu for mobile -->
            <div x-show="open"
                 x-transition
                 @click.away="open = false"
                 class="absolute right-0 mt-2 w-48 bg-gray-50 border shadow-md rounded-md z-50"
                 style="display: none;">

                <div class="flex flex-col px-4 py-3 space-y-2">
                    <a href="{{ route('reader.index') }}" class="hover:text-purple-600">🏠 Home</a>
                    <a href="{{ route('reader.index') }}" class="hover:text-purple-600">📖 Novels</a>
                    <a href="{{ route('reader.genres') }}" class="hover:text-purple-600">📂 Genres</a>
                    <a href="#" class="hover:text-purple-600">⚙ Settings</a>

                </div>
            </div>
        </div>
    </div>
</nav>



<!-- 🔹 END NAVIGATION -->

<div class="container mx-auto px-4 py-6">
    @yield('content')
</div>

</body>
</html>
