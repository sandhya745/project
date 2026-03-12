@extends('layouts.admin')

@section('title', 'Author Details')

@section('content')
<div class="max-w-xl mx-auto mt-12 bg-gray-900 text-gray-100 p-8 rounded-2xl shadow-xl border border-gray-700">

    <!-- Author Name -->
    <h1 class="text-3xl font-bold mb-4 text-gray-100 border-b border-gray-700 pb-2">
        {{ $author->author_name }}
    </h1>

    <!-- Author Bio -->
    @if($author->bio)
        <p class="text-gray-300 mb-6 leading-relaxed">
            {{ $author->bio }}
        </p>
    @else
        <p class="text-gray-500 italic mb-6">No bio available.</p>
    @endif

    <!-- Books by Author -->
    <h2 class="text-xl font-semibold mb-2 text-gray-200">Books by this author</h2>
    <ul class="list-disc pl-6 mb-6 text-gray-300 space-y-1">
        @forelse($author->books as $book)
            <li class="hover:text-white transition-colors">
                {{ $book->book_name }}
            </li>
        @empty
            <li class="text-gray-500 italic">No books added yet.</li>
        @endforelse
    </ul>

    <!-- Back Button -->
    <a href="{{ url()->previous() }}"
       class="inline-block bg-gray-800 hover:bg-gray-700 text-gray-100 px-4 py-2 rounded-lg shadow hover:shadow-md transition">
       ← Back
    </a>

</div>
@endsection
