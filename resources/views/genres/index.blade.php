@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Manage Genres</h1>
     <div class="flex text-center mb-6">
    <a href="{{ route('genres.create') }}"
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
        +Add Genres
    </a>
</div>
    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="p-2">Genre</th>
            <th class="p-2">Actions</th>
        </tr>

        @foreach($genres as $genre)
        <tr class="border-t">
            <td class="p-2">{{ $genre->name }}</td>
            <td class="p-2 flex gap-2">
                <a href="{{ route('genres.edit', $genre->id) }}"
                   class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>

                <form method="POST" action="{{ route('genres.destroy', $genre->id) }}"
                      onsubmit="return confirm('Delete this genre?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
