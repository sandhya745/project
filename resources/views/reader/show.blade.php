@extends('layouts.reader')

@section('title', $book->book_name)

@section('content')
<div class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row gap-6 mb-6">
        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full md:w-64 h-auto rounded">
        @endif
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $book->book_name }}</h1>
            @if($book->author)
                <p class="text-gray-600 mb-4">By {{ $book->author->author_name }}</p>
            @endif
            @if($book->description)
                <p class="mb-4">{{ $book->description }}</p>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-semibold mb-4">Chapters</h2>
    <ul class="list-disc pl-6">
        @foreach($chapters as $chapter)
            <li class="mb-2">
                <a href="{{ route('reader.read', [$book, $chapter]) }}" class="text-blue-700 hover:underline">
                    Chapter {{ $chapter->chapter_number }}: {{ $chapter->chapter_title }}
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('reader.index') }}" class="inline-block mt-6 bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">
        ← Back to All Books
    </a>
</div>
@endsection
