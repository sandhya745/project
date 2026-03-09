@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
<h2 class="text-xl font-bold mb-4">Profile</h2>

<p><strong>Name:</strong> {{ $admin->name }}</p>
<p><strong>Email:</strong> {{ $admin->email }}</p>

<a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
    Edit Profile
</a>
@endsection
