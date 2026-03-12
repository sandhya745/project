@extends('layouts.admin')

@section('title', 'Readers')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Readers</h1>
    <table class="w-full bg-white shadow rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">ID</th>
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Registered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($readers as $reader)
                <tr class="border-b">
                    <td class="p-2">{{ $reader->id }}</td>
                    <td class="p-2">{{ $reader->name }}</td>
                    <td class="p-2">{{ $reader->email }}</td>
                    <td class="p-2">{{ $reader->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">No readers found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
