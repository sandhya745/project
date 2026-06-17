@extends('layouts.reader')

@section('title', 'Reader Dashboard')

@section('content')
    <div class="relative w-full md:w-1/3">
        <form action="{{ route('reader.dashboard') }}" method="GET">
            <input type="text" name="search" placeholder="Search books, authors..." value="{{ $search ?? '' }}"
                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <button type="submit" class="absolute right-2 top-2 text-purple-600 font-bold">🔍</button>
        </form>
    </div>
    <!-- Search Results -->
    @if (!empty($search))
        <h2 class="text-xl font-semibold mt-6 mb-4">Search Results for "{{ $search }}"</h2>
        @if ($recommended->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($recommended as $book)
                    <div class="bg-white shadow rounded overflow-hidden">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-lg">{{ $book->book_name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $book->author?->author_name ?? 'Unknown Author' }}</p>
                            <a href="{{ route('reader.show', $book) }}"
                                class="inline-block bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 mt-2">
                                📖 View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No books or authors found matching "{{ $search }}".</p>
        @endif
    @endif
    <!-- Continue Reading -->
    @if ($continueReading && $continueReading->count())
        <section>
            <h2 class="text-2xl font-semibold mb-4">📖 Continue Reading</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($continueReading as $book)
                    <div class="bg-white rounded shadow hover:shadow-md transition overflow-hidden">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800">{{ $book->book_name }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ $book->author?->author_name ?? 'Unknown Author' }}
                            </p>
                            @php
                                $lastChapter = $book->chapters()->latest('chapter_number')->first();
                            @endphp

                            @if ($lastChapter)
                                <a href="{{ route('reader.read', [$book, $lastChapter]) }}"
                                    class="inline-block bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 transition">
                                    ▶ Continue
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- <!-- Favorites -->
        @if ($favorites && $favorites->count())
            <section>
                <h2 class="text-2xl font-semibold mb-4">💖 Your Favorites</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach ($favorites as $book)
                        <div class="bg-white rounded shadow hover:shadow-md transition overflow-hidden text-center">
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-36 object-cover">
                            @endif
                            <div class="p-2">
                                <h3 class="text-sm font-medium text-gray-800">{{ $book->book_name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif --}}

    <!-- Recommended -->
    @if ($recommended && $recommended->count())
        <section>
            <h2 class="text-2xl font-semibold mb-4">🌟 Recommended for You</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($recommended as $book)
                    <div class="bg-white rounded shadow hover:shadow-md transition overflow-hidden text-center">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-36 object-cover">
                        @endif
                        <div class="p-2">
                            <h3 class="text-sm font-medium text-gray-800">{{ $book->book_name }}</h3>
                            <p class="text-gray-500 text-xs">{{ $book->author?->author_name ?? 'Unknown Author' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Genres -->
    @if ($genres && $genres->count())
        <section>
            <h2 class="text-2xl font-semibold mb-4">📂 Browse by Genres</h2>
           <div class="grid grid-cols-2 gap-6">
        @foreach($genres as $genre)
            <div class="relative">
                <a href="{{ route('reader.genre.books', $genre) }}"
                   class="block bg-gray-500 border border-gray-200 text-white px-6 py-4 rounded-xl text-center font-semibold shadow-sm
                          hover:bg-black hover:text-white hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    {{ $genre->name }} ({{ $genre->books_count }})
                </a>
            </div>
        @endforeach
    </div>
        </section>
    @endif

    </div>
@endsection
