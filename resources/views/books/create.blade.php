@extends('layouts.app')

@section('title', 'Add Book') <!-- optional: sets the <title> in your layout -->

@section('content')
<div class="max-w-lg mx-auto mt-12 p-8 bg-white rounded-xl shadow-lg">

    <!-- Title -->
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Add New Book</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('book.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Book Name -->
        <div class="flex flex-col">
            <label class="block text-gray-700 font-medium my-2">Book Name</label>
            <input type="text" name="book_name"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   placeholder="Enter book name" required>
        </div>
<br>
        <!-- Author Name -->
        <div class="flex flex-col">
            <label class="block text-gray-700 font-medium my-2">Author Name</label>
            <input type="text" name="author_name"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   placeholder="Enter author name" required>
        </div>
<br>
        <!-- Published Date -->
        <div class="flex flex-col">
            <label class="block text-gray-700 font-medium my-2">Published Date</label>
            <input type="date" name="published"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>
<br>
        <!-- Status -->
        <div class="flex flex-col">
            <label class="block text-gray-700 font-medium my-1">Status</label>
            <select name="status"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Complete">Complete</option>
                <option value="Ongoing">Ongoing</option>
            </select>
        </div>
<br>
<!-- Genre  -->
<div class="flex flex-col">
    <label class="block text-gray-700 font-medium my-2">Genre</label>
    <select name="genre_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <option value="">Select Genre</option>
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}" {{ isset($book) && $book->genre_id == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
        @endforeach
    </select>
</div>

        <!-- Submit Button -->
        <div class="text-center">
             <button type="submit"
        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
    Save Book
</button>

        </div>
    </form>
</div>
@endsection
