<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;



class BookController extends Controller
{
    // List books (with optional genre filter)
  public function index(Request $request)
{
    $genreId = $request->query('genre');

    $booksQuery = Book::with(['author', 'genre']);

    if ($genreId && Genre::where('id', $genreId)->exists()) {
        $booksQuery->where('genre_id', $genreId);
        $currentGenre = Genre::find($genreId)->name;
    } else {
        $currentGenre = 'All Books';
    }

    $books = $booksQuery->latest()->get();

    return view('books.index', compact('books', 'currentGenre'));
}


    // Show form to create a new book
    public function create()
    {
         $genres = Genre::all();
         $authors = Author::all();
    return view('books.create', compact('genres','authors'));
    }

    // Store a new book
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_name'   => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published'   => 'required|date',
            'status'      => 'nullable|string',
            'genre_id'       => 'required|exists:genres,id',
        ]);

        Book::create($data);

        return redirect()->route('book.list')->with('success', 'Book added successfully!');
    }

    // Show form to edit a book

    public function edit(Book $book)
    {

        $genres = Genre::all();
        $authors = Author::all();
        return view('books.edit', compact('book','genres','authors'));
    }

    // Update a book
    public function update(Request $request, Book $book)

    {

        $data = $request->validate([
            'book_name'   => 'required|string|max:255',
            'author_id'   => 'required|exists:authors,id',
            'published'   => 'required|date',
            'status'      => 'nullable|string',
            'genre_id'    => 'required|exists:genres,id',
        ]);

        $book->update($data);

        return redirect()->route('book.list')->with('success', 'Book updated successfully!');
    }

    // Delete a book

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('book.list')->with('success', 'Book deleted successfully!');
    }

    // Show single book
    public function show(Book $book)
    {
        $book->load('author');
        return view('books.show', compact('book'));
    }
}
