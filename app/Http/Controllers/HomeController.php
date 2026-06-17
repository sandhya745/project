<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   public function index()
{
    // If logged in
    if (Auth::check()) {

        // Admin → admin dashboard
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Reader → go to reader dashboard (NOT books.index)
        return redirect()->route('reader.dashboard');
    }

    // Guest → show welcome page
    $genres = Genre::withCount('books')->get();
    $totalBooks = Book::count();

    return view('welcome', compact('genres', 'totalBooks'));
}
}
