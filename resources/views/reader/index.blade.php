@extends('layouts.reader')

@section('title', 'All Books')

@section('content')
<div class="max-w-6xl mx-auto mt-12 px-4">

    <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">All Books</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        @forelse($books as $book)
            <div class="bg-white border rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">

                <!-- Cover Image -->
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         class="w-full h-64 object-cover rounded-t-xl">
                @elseif($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}"
                         class="w-full h-64 object-cover rounded-t-xl">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400 rounded-t-xl">
                        No Cover
                    </div>
                @endif

                <!-- Book Info -->
                <div class="p-4">
                    <h2 class="italic text-lg font-semibold text-gray-800">
                        {{ $book->book_name }}
                        <a href="{{ route('reader.show', $book) }}" class="text-blue-500 text-sm ml-1 hover:underline">

                        </a>
                    </h2>

                    <p>
                            Author:
                            @if ($book->author)
                                <a href="{{ route('authors.show', $book->author) }}"
                                    class="text-gray-600 hover:underline font-medium">
                                    {{ $book->author->author_name }}
                                </a>
                                <span class="text-sm text-blue-500 ml-1">
                                    (<a href="{{ route('authors.show', $book->author) }}" class="hover:underline">see
                                        details</a>)
                                </span>
                            @else
                                <span class="text-blue-500">Unknown Author</span>
                            @endif
                        </p>


                    <!-- Published Date -->
                    <p class="text-gray-600 text-sm mb-1">
                        Published: {{ $book->published ?? $book->created_at->format('Y-m-d') }}
                    </p>

                    <!-- Status with icon -->
                    <p class="flex items-center gap-1 text-sm mb-1">
                        @if($book->status == 'Complete')
                            ✅
                        @elseif($book->status == 'Pending')
                            ⏳
                        @else
                            🔄
                        @endif
                        {{ $book->status ?? 'Unknown' }}
                    </p>

                    <!-- Genre with link -->
                    <p class="italic text-gray-500 text-sm mb-2">
                        Genre:
                        @if($book->genre)
                            <a href="{{ route('reader.genres', $book->genre) }}" class="text-blue-500 hover:underline">
                                {{ $book->genre->name }}
                            </a>
                        @else
                            N/A
                        @endif
                    </p>

                    <!-- Read Book button -->
                    <a href="{{ route('reader.show', $book) }}"
                       class="inline-block text-purple-500 hover:underline font-medium">
                        Read Book
                    </a>
                </div>

            </div>
        @empty
            <p class="text-gray-500 text-center col-span-3 mt-12">
                No books available.
            </p>
        @endforelse

    </div>
</div>
@endsection
