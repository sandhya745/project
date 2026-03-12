@extends('layouts.admin')

@section('title', 'Notification Logs')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Notification Logs</h1>
    <ul class="bg-white p-4 shadow rounded space-y-2">
        @forelse($logs as $log)
            <li>• {{ $log['message'] }} - <span class="text-gray-500">{{ $log['date']->format('Y-m-d H:i') }}</span></li>
        @empty
            <li>No logs found</li>
        @endforelse
    </ul>
</div>
@endsection
