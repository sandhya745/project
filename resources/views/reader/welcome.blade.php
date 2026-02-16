@extends('layouts.reader')

@section('title', 'Welcome to Novel Reader')

@section('content')
<div class="max-w-6xl mx-auto mt-12">

    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">All Books</h1>

    {{-- Books Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center">
        @forelse($books as $book)
            <div class="border rounded-lg shadow p-4 w-full max-w-xs">
                {{-- Cover Image --}}
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         class="w-full h-64 max-h-64 object-cover rounded mb-4">
                @elseif($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}"
                         class="w-full h-64 max-h-64 object-cover rounded mb-4">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500 rounded mb-4">
                        No Cover
                    </div>
                @endif

                {{-- Book Info --}}
                <h2 class="text-xl font-semibold mb-1">{{ $book->book_name }}</h2>
                <p class="text-gray-600 mb-2">By {{ $book->author->author_name ?? 'Unknown' }}</p>

                {{-- View Chapters --}}
                <a href="{{ route('reader.show', $book) }}"
                   class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition block text-center">
                   View Chapters
                </a>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-3">No books available at the moment.</p>
        @endforelse
    </div>


</div>
@endsection
