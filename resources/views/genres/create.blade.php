@extends('layouts.admin')

@section('title', 'Add Genre')

@section('content')
<div class="max-w-lg mx-auto mt-12 p-8 bg-white rounded-xl shadow-lg">

    <h1 class="text-3xl font-bold mb-6 text-center">Add New Genre</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('genres.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="return_to" value="{{ request('return_to') }}">
        <div class="flex flex-col">
            <label class="block text-gray-700 font-medium mb-2">Genre Name</label>
            <input type="text" name="name"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-gray-400 focus:outline-none"
                   placeholder="Enter genre name" required>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Add Genre
            </button>
        </div>
    </form>
</div>
@endsection
