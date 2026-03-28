@extends('layouts.admin')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Chapters</h1>

    <a href="{{ route('chapters.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        + Add Chapter
    </a>

    <div class="mt-6 bg-white shadow rounded-lg p-4">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">ID</th>
                    <th class="p-2">Book</th>
                    <th class="p-2">Chapter No</th>
                    <th class="p-2">Title</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($chapters as $chapter)
                <tr class="border-b">
                    <td class="p-2">{{ $chapter->id }}</td>
                    <td class="p-2">{{ $chapter->book->book_name }}</td>
                    <td class="p-2">{{ $chapter->chapter_number }}</td>
                    <td class="p-2">{{ $chapter->chapter_title }}</td>
                    <td class="p-2">
                        <a href="{{ route('chapters.edit', $chapter->id) }}"
                           class="text-blue-500">Edit</a>

                        <form action="{{ route('chapters.destroy', $chapter->id) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
