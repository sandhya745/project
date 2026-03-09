@extends('layouts.admin')

@section('title', $book->book_name)

@section('content')
    <div class="max-w-4xl mx-auto mt-8 p-4 border rounded shadow bg-white">

        <!-- Book Cover + Info -->
        <div class="flex gap-6 mb-4">
            <!-- Cover Image -->
            @if ($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-48 h-64 object-cover rounded shadow">
            @elseif ($book->cover_image_url)
                <img src="{{ $book->cover_image_url }}" class="w-48 h-64 object-cover rounded shadow">
            @else
                <div class="w-48 h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                    No Cover
                </div>
            @endif

            <!-- Book Info -->
            <div class="flex-1">
                <h1 class="text-3xl font-bold mb-2">{{ $book->book_name }}</h1>

                <p><strong>Author:</strong>
                    @if ($book->author)
                        <a href="{{ route('authors.show', $book->author) }}" class="text-blue-500 hover:underline">
                            {{ $book->author->author_name }}
                        </a>
                    @else
                        Unknown
                    @endif
                </p>

                <p><strong>Genre:</strong> {{ $book->genre?->name ?? 'Unknown' }}</p>
                <p><strong>Published:</strong> {{ $book->published }}</p>
                <p><strong>Status:</strong> {{ $book->status ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Book Synopsis -->
        <div class="mt-4" x-data="{ open: false }">
            <h2 class="text-2xl font-semibold mb-2">Synopsis</h2>

            <!-- Synopsis Preview -->
            <p class="text-gray-700" x-show="!open">
                {{ Str::limit($book->synopsis ?? 'No synopsis available.', 200) }}
                <span class="text-blue-500 cursor-pointer" @click="open = true"
                    x-show="{{ strlen($book->synopsis ?? '') > 200 }}">Read more</span>
            </p>

            <!-- Full Synopsis -->
            <p class="text-gray-700" x-show="open">
                {{ $book->synopsis ?? 'No synopsis available.' }}
                <span class="text-blue-500 cursor-pointer" @click="open = false">Read less</span>
            </p>
        </div>


        <div class="mt-4">
            <a href="{{ route('books.index') }}" class="text-blue-500 hover:underline">← Back to Books</a>
        </div>
    </div>
@endsection
