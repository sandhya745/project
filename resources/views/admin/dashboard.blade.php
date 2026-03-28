@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-slate-100">

        <!-- Mobile Toggle Button with Arrow -->
        <button @click="sidebarOpen = !sidebarOpen"
            class="md:hidden p-2 m-2 absolute z-50 bg-white rounded-lg shadow flex items-center justify-center">
            <!-- Arrow Icon -->
            <svg :class="{ 'rotate-180': sidebarOpen }" class="w-6 h-6 transform transition-transform duration-300"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M9 18l6-6-6-6"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <aside :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
            class="fixed md:relative z-40  bg-slate-800 text-slate-200 shadow-xl min-h-screen p-4 transition-transform duration-300">

            <div class="text-xl font-bold text-white mb-6">Duskhub Admin</div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center">Home</a>

                <!-- Admin Menu -->
                <div x-data="{ open: true }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center">
                        <span>Admin</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('books.index') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Books</a>
                        <a href="{{ route('authors.index') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Authors</a>
                        <a href="{{ route('genres.index') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Genres</a>
                    </div>
                </div>

                <!-- Users Menu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Users</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('users.readers') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Readers</a>
                    </div>
                </div>

                <!-- Reports Menu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Reports</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('reports.analytics') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Analytics</a>
                    </div>
                </div>

                <!-- Notifications / Logs -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Notifications</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('notifications.logs') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Logs</a>
                    </div>
                </div>

                <!-- Settings Menu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex justify-between w-full py-2 px-4 rounded-lg hover:bg-slate-700 transition items-center mt-2">
                        <span>Settings</span>
                        <span x-show="!open">➕</span>
                        <span x-show="open">➖</span>
                    </button>

                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('settings.site') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Site Settings</a>
                        <a href="{{ route('settings.backup') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Backup / Restore</a>
                        <a href="{{ route('settings.newsletter') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Newsletter / Email</a>
                        <a href="{{ route('profile.show') }}"
                            class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition">Profile</a>
                    </div>
                </div>

                <!-- Help / Documentation -->
                <a href="{{ route('help') }}" class="block py-2 px-4 rounded-lg hover:bg-slate-700 transition mt-2">Help /
                    Documentation</a>

            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1  transition-all duration-300">

            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-xl shadow">
                <!-- Left: Dashboard Title -->
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <!-- Right: Search + Notifications + Profile -->
                <div class="flex items-center space-x-6">
                    <!-- Search Form -->
                    <form action="{{ route('books.index') }}" method="GET" class="flex space-x-2">
                        <input type="text" name="search" placeholder="Search books..." value="{{ request('search') }}"
                            class="px-3 py-2 rounded-lg bg-gray-100 border-none focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition">
                            Search
                        </button>
                    </form>

                    <!-- Notifications -->
                    <div x-data="{
                        openNotifications: false,
                        notifications: [
                            { id: 1, message: 'New book added', read: false },
                            { id: 2, message: 'User registered', read: false },
                            { id: 3, message: 'Server backup completed', read: true }
                        ]
                    }" class="relative">

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
                                <div :class="{ 'bg-gray-100': !n.read }" class="px-4 py-2 border-b last:border-b-0">
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

                </div>
            </div>


            <!-- Dashboard Counts -->
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="bg-grey p-5 shadow-md rounded-xl text-center">
                    <h3 class="font-bold">Published Books</h3>
                    <p class="text-2xl">{{ $totalBooks }}</p>
                </div>
                <div class="bg-grey p-4 shadow rounded text-center">
                    <h3 class="font-bold">Authors</h3>
                    <p class="text-2xl">{{ $totalAuthors }}</p>
                </div>
                <div class="bg-grey p-4 shadow rounded text-center">
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
                gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)'); // Indigo 600
                gradient.addColorStop(1, 'rgba(147, 197, 253, 0.2)'); // Indigo 200
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
                            borderWidth: 3,
                            pointRadius: 6
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
                            x: {
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 10
                                }
                            },
                            y: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }
                    }
                });
            </script>
        @endsection
