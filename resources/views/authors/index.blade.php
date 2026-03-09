@extends('layouts.admin')

@section('title', 'Manage Authors')

@section('content')
<div class="max-w-4xl mx-auto mt-12 bg-gray-50 p-6 rounded-xl shadow">

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Authors</h1>

        <a href="{{ route('authors.create') }}"
           class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
            + Add Author
        </a>
    </div>

    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="p-2 text-left">Author</th>
            <th class="p-2 text-left">Bio</th>
            <th class="p-2">Actions</th>
        </tr>

        @foreach($authors as $author)
        <tr class="border-t">
            <td class="p-2 font-medium">{{ $author->author_name }}</td>
            <td class="p-2 text-gray-600">{{ \Illuminate\Support\Str::limit($author->bio, 60) }}</td>
            <td class="p-2 flex gap-2 justify-center">
                <a href="{{ route('authors.edit', $author) }}"
                   class="text-blue-600 hover:underline">Edit</a>

                <form method="POST" action="{{ route('authors.destroy', $author) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline"
                            onclick="return confirm('Delete this author?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>
@endsection
