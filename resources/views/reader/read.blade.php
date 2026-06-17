@extends('layouts.reader')

@section('title', $book->book_name . ' - Chapter ' . $chapter->chapter_number)


@section('content')
    <div class="min-h-screen bg-white text-black dark:bg-gray-900 dark:text-white transition-colors duration-300">

        <div class="container mx-auto p-6 max-w-4xl">

            <h1 class="text-3xl font-bold mb-2 text-center">
                {{ $book->book_name }}
            </h1>

            <!-- Chapter Number & Title -->
            <div class="text-center mb-6">
                <p class="text-gray-500 dark:text-gray-400 text-sm uppercase tracking-wide mb-1">
                    Chapter {{ $chapter->chapter_number }}
                </p>

                <h2 class="text-2xl font-semibold">
                    {{ $chapter->chapter_title }}
                </h2>
                {{-- <!-- Bookmark Button -->
                <div class="flex justify-end mb-4">

                    <form method="POST" action="{{ route('bookmark.toggle') }}">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">

                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">

                            📌 Bookmark
                        </button>
                    </form>

                </div> --}}
            </div>

            <!-- Chapter Content -->
            <div class="prose dark:prose-invert max-w-none mb-8">
                {!! nl2br(e($chapter->content)) !!}
            </div>

            <!-- Chapter Navigation -->
            <div class="flex justify-between items-center mt-6">

                @if (isset($prevChapter))
                    <a href="{{ route('reader.read', [$book, $prevChapter]) }}"
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 h-10 px-5 py-2 flex items-center justify-center rounded-lg shadow-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition-all whitespace-nowrap">
                        ← Previous Chapter
                    </a>
                @else
                    <span class="h-10 px-5 py-2 invisible">Placeholder</span>
                @endif

                @if (isset($nextChapter))
                    <a href="{{ route('reader.read', [$book, $nextChapter]) }}"
                        class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 h-10 px-5 py-2 flex items-center justify-center rounded-lg shadow-sm hover:bg-blue-200 dark:hover:bg-blue-800 transition-all whitespace-nowrap">
                        Next Chapter →
                    </a>
                @else
                    <span class="h-10 px-5 py-2 invisible">Placeholder</span>
                @endif

            </div>

            <!-- Back to Chapters -->
            <div class="flex justify-center mt-4">
                <a href="{{ route('reader.show', $book) }}"
                    class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-lg shadow-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition-all">
                    ← Table of Contents
                </a>
            </div>

        </div>
    </div>
@endsection
