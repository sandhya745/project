<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

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

        return view('books.create', compact('genres', 'authors'));
    }

    // Store a new book
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_name' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'author_id' => 'required|exists:authors,id',
            'published' => 'required|date',
            'status' => 'nullable|string',
            'genre_id' => 'required|exists:genres,id',
        ]);
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('book_covers', 'public');
        }
        Book::create($data);

        return redirect()->route('book.list')->with('success', 'Book added successfully!');
    }

    // Show form to edit a book

    public function edit(Book $book)
    {

        $genres = Genre::all();
        $authors = Author::all();

        return view('books.edit', compact('book', 'genres', 'authors'));
    }

    // Update a book
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'book_name' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_image_url' => 'nullable|url',
            'author_id' => 'required|exists:authors,id',
            'published' => 'required|date',
            'status' => 'nullable|string',
            'genre_id' => 'required|exists:genres,id',
        ]);

        // Remove cover if checkbox ticked
        if ($request->has('remove_cover') && $request->remove_cover == 1) {
            if ($book->cover_image && \Storage::disk('public')->exists($book->cover_image)) {
                \Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = null;
            $data['cover_image_url'] = null;
        }
        // If new local image uploaded, save it and remove URL
        elseif ($request->hasFile('cover_image')) {
            if ($book->cover_image && \Storage::disk('public')->exists($book->cover_image)) {
                \Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('book_covers', 'public');
            $data['cover_image_url'] = null;
        }
        // If URL is provided, save it and remove local file
        elseif ($request->filled('cover_image_url')) {
            if ($book->cover_image && \Storage::disk('public')->exists($book->cover_image)) {
                \Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = null;
            $data['cover_image_url'] = $request->cover_image_url;
        }
        // Else keep old values if neither uploaded nor URL provided
        else {
            $data['cover_image'] = $book->cover_image;
            $data['cover_image_url'] = $book->cover_image_url;
        }

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
