@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
    <div class="max-w-lg mx-auto mt-12 p-8 bg-white rounded-xl shadow-lg">

        <!-- Title -->
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Edit Book</h1>

        <!-- Success message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Book Name -->
            <div class="flex flex-col mb-4">
                <label class="block text-gray-700 font-medium mb-2">Book Name</label>
                <input type="text" name="book_name" value="{{ old('book_name', $book->book_name) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter book name">
            </div>

            <!-- Author Select -->
            <div class="flex flex-col mb-4">
                <label class="block text-gray-700 font-medium mb-2">Author</label>

                <select name="author_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
                            {{ $author->author_name }}
                        </option>
                    @endforeach
                </select>

                <a href="{{ route('authors.create', ['return_to' => url()->current()]) }}"
                    class="mt-2 text-sm text-blue-600 hover:underline">
                    + Change Author
                </a>

            </div>


            <!-- Published Date -->
            <div class="flex flex-col mb-4">
                <label class="block text-gray-700 font-medium mb-2">Published Date</label>
                <input type="date" name="published" value="{{ old('published', $book->published) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Status -->
            <div class="flex flex-col mb-4">
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Status</option>
                    <option value="Pending" {{ old('status', $book->status) == 'Pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="Complete" {{ old('status', $book->status) == 'Complete' ? 'selected' : '' }}>Complete
                    </option>
                    <option value="Ongoing" {{ old('status', $book->status) == 'Ongoing' ? 'selected' : '' }}>Ongoing
                    </option>
                </select>
            </div>

            <!-- Genre -->
            <div class="flex flex-col mb-4">
                <label class="block text-gray-700 font-medium mb-2">Genre</label>
                <select name="genre_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                <!-- ALWAYS VISIBLE -->
                <a href="{{ route('genres.create') }}?return_to={{ url()->current() }}"
                    class="mt-2 text-sm text-blue-600 hover:underline">
                    + Change Genre
                </a>
            </div>
            <!-- Cover Image -->
            <div class="flex flex-col mb-4">
                <label class="block text-gray-700 font-medium mb-2">Book Cover</label>

                {{-- Show current cover --}}
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                        class="w-32 h-44 object-cover mb-2 rounded shadow">
                @elseif ($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}" class="w-32 h-44 object-cover mb-2 rounded shadow">
                @else
                    <div class="w-32 h-44 bg-gray-200 flex items-center justify-center mb-2 rounded shadow">
                        No Cover
                    </div>
                @endif

                {{-- Remove Cover Button --}}
                @if ($book->cover_image || $book->cover_image_url)
                    <div class="mb-2">
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="remove_cover" value="1" class="form-checkbox">
                            <span class="text-sm text-red-600">Remove current cover</span>
                        </label>
                    </div>
                @endif

                {{-- Upload new file --}}
                <input type="file" name="cover_image" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-2">

                {{-- OR Paste URL --}}
                <input type="text" name="cover_image_url" value="{{ old('cover_image_url', $book->cover_image_url) }}"
                    placeholder="https://example.com/image.jpg"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>


            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white rounded px-6 py-2 hover:bg-blue-600 transition">
                    Update
                </button>
            </div>

        </form>
    </div>
@endsection
