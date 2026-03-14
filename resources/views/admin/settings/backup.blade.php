@extends('layouts.admin')

@section('title', 'Backup / Restore')

@section('content')
<div class="p-6 bg-white rounded shadow space-y-4">
    <h1 class="text-2xl font-bold mb-4">Backup / Restore</h1>
    <p>Manage backups and restore your data.</p>

    @if(session('success'))
        <div class="p-2 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Backup -->
    <form method="POST" action="{{ route('settings.backup.create') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Create Backup
        </button>
    </form>

    <!-- Restore Backup -->
    <form method="POST" action="{{ route('settings.backup.restore') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="backup_file" class="mb-2">
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Restore Backup
        </button>
    </form>
</div>
@endsection
