@extends('layouts.reader')

@section('title', $genre->name)

@section('content')
<div class="max-w-6xl mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">{{ $genre->name }} Books</h1>

    @if($books->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
            <div class="bg-white border rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                <!-- Book Cover -->
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         alt="{{ $book->book_name }}"
                         class="w-full h-48 object-cover rounded-t-xl">
                @elseif($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}"
                         alt="{{ $book->book_name }}"
                         class="w-full h-48 object-cover rounded-t-xl">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 rounded-t-xl">
                        No Cover
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $book->book_name }}</h2>
                    <p class="text-gray-500 text-sm mb-2">By {{ $book->author->author_name }}</p>
                    @if($book->synopsis)
                        <div x-data="{ expanded: false }" class="mb-3">
                            <p class="text-gray-600 text-sm" :class="{ 'line-clamp-3': !expanded }">
                                {{ $book->synopsis }}
                            </p>
                            <button @click="expanded = !expanded"
                                    class="text-blue-500 text-xs mt-1 hover:underline">
                                <span x-text="expanded ? 'Read less' : 'Read more'"></span>
                            </button>
                        </div>
                    @endif
                    <a href="{{ route('reader.show', $book) }}"
                       class="inline-block text-purple-500 hover:underline font-medium">
                       Read Book
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <p class="text-gray-500 text-center mt-12">No books available in this genre.</p>
    @endif
</div>
@endsection
