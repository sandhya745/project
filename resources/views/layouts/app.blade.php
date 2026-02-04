<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Books App')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic:wght@100..400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">
     <!-- 🔹 GLOBAL NAVIGATION -->
    <nav class="bg-white shadow-md mb-6">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-bold text-gray-800">📚 Dusk_Translations</h1>

            <div class="flex gap-6 text-gray-700 font-medium">
                <a href="{{ route('book.list') }}" class="hover:text-blue-600 transition">Books</a>
                <a href="{{ route('genres.index') }}" class="hover:text-blue-600 transition">Genres</a>
                <a href="{{ route('authors.index') }}" class="hover:text-blue-600 transition">Authors</a>
            </div>

        </div>
    </nav>
    <!-- 🔹 END NAVIGATION -->
    <div class="container mx-auto px-4 py-6">
        @yield('content') <!-- Your page content will appear here -->
    </div>

</body>

</html>
