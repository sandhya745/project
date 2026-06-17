@extends('layouts.reader')

@section('title', $book->book_name)

@section('content')
    <div class="container mx-auto p-6">

   <div class="container mx-auto p-6">

    <!-- Book Info Section -->
    <div class="flex flex-col md:flex-row gap-6 mb-6">
        @if ($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}"
                 class="w-full md:w-64 rounded shadow">
        @endif

        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-2">{{ $book->book_name }}</h1>

            <p class="mb-2">
                Author:
                @if ($book->author)
                    <a href="{{ route('authors.show', $book->author) }}" class="text-gray-600 hover:underline font-medium">
                        {{ $book->author->author_name }}
                    </a>
                    <span class="text-sm text-blue-500 ml-1">
                        (<a href="{{ route('authors.show', $book->author) }}" class="hover:underline">see details</a>)
                    </span>
                @else
                    <span class="text-blue-500">Unknown Author</span>
                @endif
            </p>

            @if ($book->synopsis)
                <div x-data="{ expanded: false }" class="mb-3">
                    <p class="text-gray-600 text-sm" :class="{ 'line-clamp-3': !expanded }">
                        Synopsis: <br>{{ $book->synopsis }}
                    </p>
                    <button @click="expanded = !expanded" class="text-blue-500 text-xs mt-1 hover:underline">
                        <span x-text="expanded ? 'Read less' : 'Read more'"></span>
                    </button>
                </div>
            @endif

            <p class="mb-4">{{ $book->description }}</p>

            <!-- Reading Buttons -->
            <div class="flex flex-wrap gap-2">
                @if ($chapters->count())
                    <a href="{{ route('reader.read', [$book->id, $chapters->first()->id]) }}"
                       class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        ▶ Start Reading
                    </a>
                @endif

                @if (session('last_read_' . $book->id))
                    <a href="{{ route('reader.read', [$book->id, session('last_read_' . $book->id)]) }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        📖 Continue Reading
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Chapters Section -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Chapters</h2>

        <ul class="space-y-2">
            @foreach ($chapters as $chapter)
                <li class="bg-white p-3 rounded shadow hover:bg-gray-50">
                    <a href="{{ route('reader.read', [$book->id, $chapter->id]) }}" class="text-blue-700 hover:underline">
                        Chapter {{ $chapter->chapter_number }}: {{ $chapter->chapter_title }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="flex justify-center mt-6">
            <a href="{{ route('reader.index') }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                ← Back to All Books
            </a>
        </div>
    </div>

</div>
        </div>
    @endsection
