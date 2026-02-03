@extends('layouts.app')

@section('title', 'Books List')

@section('content')

<div class="max-w-4xl mx-auto mt-8">

    <!-- Centered Title -->
    <h1 class="text-3xl font-bold text-center mb-6">{{ $currentGenre }}</h1>


    <!-- Add New Book Button at bottom right -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('book.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Add New Book
        </a>
    </div>
<br>
    <!-- Book List -->
    <div class="space-y-4">
        @forelse ($books as $book)
            <div class="border p-4 rounded shadow-sm hover:shadow-md transition flex justify-between items-start">
                <!-- Book Info -->
                <div>
                    <h2 class="text-xl font-semibold">{{ $book->book_name }}</h2>
                    <p>Author: {{ $book->author_name }}</p>
                    <p>Published: {{ $book->published }}</p>
                    <p>Status: {{ $book->status }}</p>
                     <p>Genre: {{ $book->genre }}</p>
                </div>

                <!-- Edit/Delete Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('book.edit', $book->id) }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('book.destroy', $book->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
          @empty
    <p class="text-center text-gray-500">No books found for this genre.</p>
        @endforelse
    </div>

</div>

@endsection
