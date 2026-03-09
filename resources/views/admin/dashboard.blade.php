@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 text-xl font-bold">Duskhub Admin</div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-6 hover:bg-indigo-100">Dashboard</a>
                <a href="{{ route('books.index') }}" class="block py-2 px-6 hover:bg-indigo-100">Books</a>
                <a href="{{ route('authors.index') }}" class="block py-2 px-6 hover:bg-indigo-100">Authors</a>
                <a href="{{ route('genres.index') }}" class="block py-2 px-6 hover:bg-indigo-100">Genres</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search..." class="px-3 py-2 rounded border border-gray-300">
                    <button class="relative">
                        🔔
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <img src="https://via.placeholder.com/32" class="rounded-full">
                </div>
            </div>

            <!-- Dashboard Counts -->
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="font-bold">Published Books</h3>
                    <p class="text-2xl">{{ $totalBooks }}</p>
                </div>
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="font-bold">Authors</h3>
                    <p class="text-2xl">{{ $totalAuthors }}</p>
                </div>
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="font-bold">Genres</h3>
                    <p class="text-2xl">{{ $totalGenres }}</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="bg-white p-4 shadow rounded mb-6">
                <h2 class="text-lg font-semibold mb-2">Books Added Over Time</h2>
                <canvas id="booksChart" class="w-full h-64"></canvas>
            </div>

            <!-- Latest Activities -->
            <div class="bg-white p-4 shadow rounded">
                <h2 class="text-lg font-semibold mb-2">Latest Activities</h2>
                <ul class="text-gray-600 text-sm space-y-2">
                    @forelse($latestActivities as $activity)
                        <li>• {{ $activity->book_name }} ({{ $activity->status }})</li>
                    @empty
                        <li>No recent books found</li>
                    @endforelse
                </ul>
            </div>

            <!-- Recent Tasks -->
            <div class="bg-white p-4 shadow rounded">
                <h2 class="text-lg font-semibold mb-2">Recent Tasks</h2>
                <ul class="text-gray-600 text-sm space-y-2">
                    @forelse($recentTasks as $task)
                        <li>• {{ $task }}</li>
                    @empty
                        <li>No tasks found</li>
                    @endforelse
                </ul>
            </div>



            <!-- Optional: Chart.js for charts -->
           <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('booksChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels ?? []) !!},
            datasets: [{
                label: 'Books Added',
                data: {!! json_encode($chartData ?? []) !!},
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
        @endsection
