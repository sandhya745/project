@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="max-w-4xl mx-auto mt-12">

    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Book Genres</h1>
      <a href="{{ route('book.list') }}"
       class="bg-black/80 hover:bg-black text-white text-sm px-4 py-2 rounded-md shadow-sm transition">
        All Books({{ $totalBooks }})
    </a>
<br><br>
    <div class="grid grid-cols-2 gap-6">
@foreach($genres as $genre)
    <div class="relative">
        <a href="{{ route('book.list', ['genre' => $genre->id]) }}"
           class="block bg-gray-500 border border-gray-200 text-white-900 px-6 py-4 rounded-xl text-center font-semibold shadow-sm
          hover:bg-black hover:text-white hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
            {{ $genre->name }} ({{ $genre->books_count }})
        </a>


    </div>
@endforeach
</div>


</div>
@endsection
