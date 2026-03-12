@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Reports / Analytics</h1>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-5 shadow-md rounded-xl text-center">
            <h3 class="font-bold">Published Books</h3>
            <p class="text-2xl">{{ $totalBooks }}</p>
        </div>
        <div class="bg-white p-5 shadow-md rounded-xl text-center">
            <h3 class="font-bold">Authors</h3>
            <p class="text-2xl">{{ $totalAuthors }}</p>
        </div>
        <div class="bg-white p-5 shadow-md rounded-xl text-center">
            <h3 class="font-bold">Genres</h3>
            <p class="text-2xl">{{ $totalGenres }}</p>
        </div>
    </div>

    <div class="bg-white p-4 shadow rounded mb-6">
        <h2 class="text-lg font-semibold mb-2">Books Added Over Time</h2>
        <canvas id="booksChart" class="w-full h-64"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('booksChart').getContext('2d');

const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
gradient.addColorStop(1, 'rgba(147, 197, 253, 0.2)');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Books Added',
            data: @json($chartData),
            borderColor: 'rgba(99, 102, 241, 1)',
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: 'rgba(99, 102, 241, 1)',
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
            y: { beginAtZero: true, precision: 0 },
            x: { ticks: { autoSkip: true, maxTicksLimit: 10 } }
        }
    }
});
</script>
@endsection
