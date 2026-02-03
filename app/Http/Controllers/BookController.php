<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    // List books (with optional genre filter)
    public function index(Request $request)
{
 $genreId = $request->query('genre');

    if ($genreId) {
        $books = Book::where('genre_id', $genreId)->get();
        $currentGenre = Genre::find($genreId)?->name ?? 'Unknown Genre';
    } else {
        $books = Book::all();
        $currentGenre = 'All Books';
    }

    return view('books.index', compact('books', 'currentGenre'));
}

    // Show form to create a new book
    public function create()
    {
         $genres = Genre::all();
    return view('books.create', compact('genres'));
    }

    // Store a new book
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_name'   => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'published'   => 'required|date',
            'status'      => 'nullable|string',
            'genre_id'       => 'required|exists:genres,id',
        ]);

        Book::create($data);

        return redirect()->route('book.list')->with('success', 'Book added successfully!');
    }

    // Show form to edit a book
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        return view('books.edit', compact('book','genres'));
    }

    // Update a book
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'book_name'   => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'published'   => 'required|date',
            'status'      => 'nullable|string',
            'genre_id'       => 'required|exists:genres,id',
        ]);

        $book->update($data);

        return redirect()->route('book.list')->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.list')->with('success', 'Book deleted successfully!');
    }

    // Show single book
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
