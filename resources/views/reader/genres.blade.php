@extends('layouts.reader')

@section('title', 'Book Genres')

@section('content')
<div class="max-w-4xl mx-auto mt-12">

    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Book Genres</h1>

    <!-- Link to all books -->
    <a href="{{ route('reader.index') }}"
       class="bg-black/80 hover:bg-black text-white text-sm px-4 py-2 rounded-md shadow-sm transition">
        All Books ({{ \App\Models\Book::count() }})
    </a>

    <br><br>

    <!-- Grid of genres -->
    <div class="grid grid-cols-2 gap-6">
        @foreach($genres as $genre)
            <div class="relative">
                <a href="{{ route('reader.genre.books', $genre) }}"
                   class="block bg-gray-500 border border-gray-200 text-white px-6 py-4 rounded-xl text-center font-semibold shadow-sm
                          hover:bg-black hover:text-white hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    {{ $genre->name }} ({{ $genre->books_count }})
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
