@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Profile</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
@endif

<form action="{{ route('profile.update') }}" method="POST" class="space-y-4 max-w-md">
    @csrf

    <div>
        <label class="block font-semibold mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="w-full border px-3 py-2 rounded">
        @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full border px-3 py-2 rounded">
        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Password (leave blank to keep current)</label>
        <input type="password" name="password" class="w-full border px-3 py-2 rounded">
        @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Profile</button>
</form>
@endsection
