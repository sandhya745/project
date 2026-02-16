@extends('layouts.reader')

@section('title', 'All Books')

@section('content')
<div class="max-w-4xl mx-auto mt-8">

    <!-- Centered Title -->
    <h1 class="text-3xl font-bold text-center mb-6">All Books</h1>

    <!-- Book List -->
    <div class="space-y-4">
        @forelse ($books as $book)
            <div class="border p-4 rounded shadow-sm hover:shadow-md transition flex items-start gap-6">

                <!-- Book Cover -->
                <div class="flex-shrink-0">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             class="w-32 h-48 object-cover rounded shadow">
                    @elseif ($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" class="w-32 h-48 object-cover rounded shadow">
                    @else
                        <div class="w-32 h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            No Cover
                        </div>
                    @endif
                </div>

                <!-- Book Info -->
                <div class="flex-1">
                    <h2 class="text-xl font-semibold">
                        {{ $book->book_name }}
                        <span class="text-sm text-blue-500 ml-2">
                            (<a href="{{ route('reader.show', $book) }}" class="hover:underline">View Chapters</a>)
                        </span>
                    </h2>

                    <p>
                        Author:
                        @if ($book->author)
                            <span class="text-gray-600 font-medium">{{ $book->author->author_name }}</span>
                        @else
                            <span class="text-blue-500">Unknown Author</span>
                        @endif
                    </p>

                    <p>Published: {{ $book->published ?? 'N/A' }}</p>
                    <p class="flex items-center gap-1 text-gray-400">
                        @if ($book->status == 'Complete')
                            ✅
                        @elseif($book->status == 'Pending')
                            ⏳
                        @else
                            🔄
                        @endif
                        {{ $book->status }}
                    </p>

                    <p>Genre: {{ $book->genre->name ?? 'Unknown' }}</p>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-500">No books found.</p>
        @endforelse
    </div>

</div>
@endsection
