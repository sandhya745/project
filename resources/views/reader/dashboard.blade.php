@extends('layouts.reader')

@section('title', 'Reader Dashboard')

@section('content')

{{-- 🔍 SEARCH BAR --}}
<div class="flex justify-center mb-10">
    <form action="{{ route('reader.dashboard') }}" method="GET"
          class="w-full max-w-2xl relative">

        <input type="text"
               name="search"
               placeholder="Search books, authors..."
               value="{{ request()->get('search') }}"
               class="w-full px-5 py-3 pl-12 rounded-full
                      bg-white/70 backdrop-blur-md
                      border border-gray-200 shadow-md
                      focus:outline-none focus:ring-2 focus:ring-purple-500
                      transition">

        <!-- search icon -->
        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
            🔍
        </span>

        <button type="submit"
                class="absolute right-2 top-1/2 transform -translate-y-1/2
                       bg-purple-500 hover:bg-purple-600 text-white
                       px-4 py-1 rounded-full transition">
            Go
        </button>

    </form>
</div>
{{-- 🔍 SEARCH RESULTS --}}
@if(!empty($search))
    <h2 class="text-xl font-semibold mt-6 mb-4">
        Search Results for "{{ $search }}"
    </h2>

    @if($searchResults->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($searchResults as $book)
                <div class="bg-white shadow rounded overflow-hidden">

                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-lg">{{ $book->book_name }}</h3>
                        <p class="text-gray-600 text-sm">
                            {{ $book->author?->author_name ?? 'Unknown Author' }}
                        </p>

                        <a href="{{ route('reader.show', $book) }}"
                           class="inline-block bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 mt-2">
                            📖 View
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">
            No books or authors found matching "{{ $search }}".
        </p>
    @endif
@endif


{{-- 📖 CONTINUE READING --}}
@if($continueReading->count())
    <section class="mt-10">
        <h2 class="text-2xl font-semibold mb-4">📖 Continue Reading</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($continueReading as $book)
                <div class="bg-white rounded shadow hover:shadow-md transition overflow-hidden">

                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800">
                            {{ $book->book_name }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-2">
                            {{ $book->author?->author_name ?? 'Unknown Author' }}
                        </p>

                        @php
                            $lastChapter = $book->chapters()
                                ->latest('chapter_number')
                                ->first();
                        @endphp

                        @if($lastChapter)
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


{{-- 🌟 RECOMMENDED BOOKS --}}
@if($recommended->count())
    <section class="mt-10">
        <h2 class="text-2xl font-semibold mb-4">🌟 Recommended for You</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($recommended as $book)
                <div class="bg-white rounded shadow hover:shadow-md transition overflow-hidden text-center">

                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             class="w-full h-36 object-cover">
                    @endif

                    <div class="p-2">
                        <h3 class="text-sm font-medium text-gray-800">
                            {{ $book->book_name }}
                        </h3>

                        <p class="text-gray-500 text-xs">
                            {{ $book->author?->author_name ?? 'Unknown Author' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif


{{-- 📂 GENRES --}}
@if($genres->count())
    <section class="mt-10">
        <h2 class="text-2xl font-semibold mb-4">📂 Browse by Genres</h2>

        <div class="grid grid-cols-2 gap-6">
            @foreach($genres as $genre)
                <a href="{{ route('reader.genre.books', $genre) }}"
                   class="block bg-gray-500 text-white px-6 py-4 rounded-xl text-center font-semibold shadow-sm
                          hover:bg-black hover:shadow-lg transition duration-300 transform hover:-translate-y-1">

                    {{ $genre->name }} ({{ $genre->books_count }})
                </a>
            @endforeach
        </div>
    </section>
@endif

@endsection
