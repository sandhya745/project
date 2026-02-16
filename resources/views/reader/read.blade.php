@extends('layouts.reader')

@section('title', $book->book_name . ' - Chapter ' . $chapter->chapter_number)

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <h1 class="text-3xl font-bold mb-2">{{ $book->book_name }}</h1>
    <h2 class="text-xl font-semibold mb-6">Chapter {{ $chapter->chapter_number }}: {{ $chapter->chapter_title }}</h2>

    <div class="prose mb-8">
        {!! nl2br(e($chapter->content)) !!}
    </div>

    <div class="flex justify-between">
        @if(isset($prevChapter))
            <a href="{{ route('reader.read', [$book, $prevChapter]) }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Previous Chapter
            </a>
        @else
            <span></span>
        @endif

        @if(isset($nextChapter))
            <a href="{{ route('reader.read', [$book, $nextChapter]) }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">
                Next Chapter →
            </a>
        @else
            <span></span>
        @endif
    </div>

    <a href="{{ route('reader.show', $book) }}" class="inline-block mt-6 bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">
        ← Back to Chapters
    </a>
</div>
@endsection
