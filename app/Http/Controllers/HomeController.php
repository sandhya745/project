<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Book;


class HomeController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('books')->get(); // adds 'books_count' attribute
        $totalBooks = Book::count(); // total number of books

        return view('welcome', compact('genres', 'totalBooks'));
    }
}
