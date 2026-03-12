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
        // Check if the user is logged in
        if (Auth::check()) {
            // If admin, redirect to admin dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('reader.index');
            }
            // Otherwise, continue to reader welcome page
        }

        // For guests or regular readers, load welcome page data
        $genres = Genre::withCount('books')->get(); // Count books per genre
        $totalBooks = Book::count(); // Total books in system

        return view('welcome', compact('genres', 'totalBooks'));
    }
}
