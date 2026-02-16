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
<nav class="bg-white shadow-md mb-6">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <h1 class="text-xl font-bold text-gray-800">📚 Dusk_Translations</h1>

        <div class="flex gap-6 text-gray-700 font-medium">
            <a href="{{ route('reader.index') }}"
               class="text-purple-400 hover:text-blue-600 transition">
               Books
            </a>

            <a href="{{ route('reader.genres') }}"
               class="text-green-400 hover:text-blue-600 transition">
               Genres
            </a>


        </div>

    </div>
</nav>
<!-- 🔹 END NAVIGATION -->

<div class="container mx-auto px-4 py-6">
    @yield('content')
</div>

</body>
</html>
