@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
<div class="max-w-lg mx-auto mt-12 bg-gray-50 p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
        Edit Author
    </h1>

    <form method="POST" action="{{ route('authors.update', $author) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700 mb-1">Author Name</label>
            <input type="text" name="author_name"
                   value="{{ $author->author_name }}" required
                   class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-gray-500">
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" rows="4"
                      class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-gray-500">{{ $author->bio }}</textarea>
        </div>

        <div class="text-center">
            <button class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
                Update Author
            </button>
        </div>
    </form>
</div>
@endsection
