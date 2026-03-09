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
                <!-- Left: Dashboard Title -->
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <!-- Right: Search + Notifications + Profile -->
                <div class="flex items-center space-x-6">
                    <!-- Search Form -->
                    <form action="{{ route('books.index') }}" method="GET" class="flex space-x-2">
                        <input type="text" name="search" placeholder="Search books..." value="{{ request('search') }}"
                            class="px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Search
                        </button>
                    </form>
                    <!--Notification-->
                    <div x-data="{ openNotifications: false, notifications: [
    { id: 1, message: 'New book added', read: false },
    { id: 2, message: 'User registered', read: false },
    { id: 3, message: 'Server backup completed', read: true }
]}" class="relative">

    <!-- Bell Button -->
    <button @click="openNotifications = !openNotifications"
        class="relative text-gray-600 hover:text-gray-800 p-1 rounded-full">
        🔔
        <!-- Red dot if any unread notifications -->
        <span x-show="notifications.some(n => !n.read)"
              class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
    </button>

    <!-- Notifications Dropdown -->
    <div x-show="openNotifications" @click.away="openNotifications = false"
        class="absolute right-0 mt-2 w-64 bg-white border rounded shadow-lg z-50">
        <template x-for="n in notifications" :key="n.id">
            <div :class="{'bg-gray-100': !n.read}" class="px-4 py-2 border-b last:border-b-0">
                <span x-text="n.message"></span>
            </div>
        </template>

        <div class="px-4 py-2 text-center">
            <button @click="notifications.forEach(n => n.read = true); openNotifications = false"
                    class="text-sm text-blue-600 hover:underline">
                Mark all as read
            </button>
        </div>
    </div>
</div>
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
                            legend: {
                                display: true
                            },
                            tooltip: {
                                enabled: true
                            }
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
