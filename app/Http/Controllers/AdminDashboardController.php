<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalBooks = Book::count();
        $totalGenres = Genre::count();
        $totalAuthors = User::where('role', 'admin')->count(); // count admins as authors
        $totalReaders = User::where('role', 'reader')->count(); // optional, if you want to show readers

        // Latest 5 books as activities
        $latestActivities = Book::orderBy('created_at', 'desc')->take(5)->get();

        // Recent tasks (dummy data for now)
        $recentTasks = [
            'Add a new book',
            'Update book info',
            'Review user reports',
            'Backup database',
            'Send newsletter',
        ];

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalGenres',
            'totalAuthors',
            'totalReaders',
            'latestActivities',
            'recentTasks'
        ));

    }
}
