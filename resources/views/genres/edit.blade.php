@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Edit Genre</h1>

    <form method="POST" action="{{ route('genres.update', $genre->id) }}">
        @csrf
        @method('PUT')

        <input type="text"
               name="name"
               value="{{ $genre->name }}"
               class="w-full border p-2 rounded mb-4">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>
@endsection
