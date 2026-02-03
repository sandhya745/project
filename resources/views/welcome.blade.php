@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="max-w-4xl mx-auto mt-12">

    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Book Genres</h1>
    <!-- Manage Genres Button -->
<div class="flex justify-center mb-4">
    <a href="{{ route('genres.index') }}"
       class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded shadow">
        Manage Genres
    </a>
</div>
    <!-- Add All Book Button at bottom right -->
    <div class="flex text-center mb-6">
        <a href="{{ route('book.list') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            All Books
        </a>
    </div>
    <div class="grid grid-cols-2 gap-6">
@foreach($genres as $genre)
    <div class="relative">
        <a href="{{ route('book.list', ['genre' => $genre->id]) }}"
           class="block bg-gray-500 hover:bg-gray-600 text-white px-6 py-4 rounded-lg text-center font-bold transition transform hover:scale-105"">
            {{ $genre->name }}
        </a>

        <!-- Edit / Delete -->
        <div class="flex justify-center gap-2 mt-2">
            <a href="{{ route('genres.edit', $genre->id) }}" class="text-blue-600">Edit</a>

            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-600">Delete</button>
            </form>
        </div>
    </div>
@endforeach
</div>


</div>
@endsection
