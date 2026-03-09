@extends('layouts.admin')

@section('title', 'Add Author')

@section('content')
<div class="max-w-lg mx-auto mt-12 bg-gray-50 p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
        Add Author
    </h1>

    <form method="POST" action="{{ route('authors.store') }}" class="space-y-5">
        @csrf
       <input type="hidden" name="return_to" value="{{ request('return_to') }}">

        <div>
            <label class="block font-medium text-gray-700 mb-1">Author Name</label>
            <input type="text" name="author_name" required
                   class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-gray-500">
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" rows="4"
                      class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-gray-500"></textarea>
        </div>

        <div class="text-center">
            <button class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
                Save Author
            </button>
        </div>
    </form>
</div>
@endsection
