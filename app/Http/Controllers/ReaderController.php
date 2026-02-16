<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Genre;

class ReaderController extends Controller
{
    // Homepage - list all books
   public function index()
{
    $books = Book::with('author', 'genre')->get();
    $genres = Genre::withCount('books')->get(); // Count of books per genre
    $totalBooks = $books->count(); // total books

    return view('reader.welcome', compact('books', 'genres', 'totalBooks'));
}


    // Single book page - show chapters
    public function show(Book $book)
    {
        $chapters = $book->chapters()->orderBy('chapter_number')->get();

        return view('reader.show', compact('book', 'chapters'));
    }

    // Read single chapter
    public function read(Book $book, Chapter $chapter)
    {
        // Safety check: ensure chapter belongs to book
        if ($chapter->book_id != $book->id) {
            abort(404);
        }
        $nextChapter = $book->chapters()
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->first();

        $prevChapter = $book->chapters()
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->latest('chapter_number')
            ->first();

        return view('reader.read', compact('book', 'chapter', 'nextChapter', 'prevChapter'));
    }
     // List all genres
    public function genres()
    {
        $genres = Genre::withCount('books')->get(); // count books in each genre
        return view('reader.genres', compact('genres'));
    }

    // List books in a specific genre
    public function genreBooks(Genre $genre)
    {
        $books = Book::where('genre_id', $genre->id)->get();
        return view('reader.genre_books', compact('genre', 'books'));
    }
}
