@extends('layouts.admin')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Chapter</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('chapters.update', $chapter->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT') <!-- Important for update -->

        <!-- Select Book -->
        <div class="mb-4">
            <label class="block mb-1">Select Book</label>
            <select name="book_id" class="w-full border p-2 rounded">
                <option value="">-- Choose a Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ $chapter->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->book_name }}
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Chapter Number -->
        <div class="mb-4">
            <label class="block mb-1">Chapter Number</label>
            <input type="number" name="chapter_number" value="{{ old('chapter_number', $chapter->chapter_number) }}" class="w-full border p-2 rounded">
            @error('chapter_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Chapter Title -->
        <div class="mb-4">
            <label class="block mb-1">Chapter Title</label>
            <input type="text" name="chapter_title" value="{{ old('chapter_title', $chapter->chapter_title) }}" class="w-full border p-2 rounded">
            @error('chapter_title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label class="block mb-1">Content</label>
            <textarea name="content" rows="10" class="w-full border p-2 rounded">{{ old('content', $chapter->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Chapter
        </button>
        <a href="{{ route('chapters.index') }}" class="ml-4 text-gray-700">Cancel</a>
    </form>
</div>

@endsection
