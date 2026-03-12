<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Genre;

class ReportController extends Controller
{
    public function analytics()
    {
        $totalBooks = Book::count();
        $totalAuthors = User::where('role', 'admin')->count();
        $totalGenres = Genre::count();

        $booksByDate = Book::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $booksByDate->pluck('date');
        $chartData = $booksByDate->pluck('count');

        return view('admin.reports.analytics', compact('totalBooks', 'totalAuthors', 'totalGenres', 'chartLabels', 'chartData'));
    }
}
