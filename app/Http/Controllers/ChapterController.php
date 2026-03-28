<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('book')->latest()->get();

        return view('admin.chapters.index', compact('chapters'));
    }

    public function create()
    {
        $books = Book::all();

        return view('admin.chapters.create', compact('books'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'chapter_number' => 'required|integer',
            'chapter_title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create the chapter
        Chapter::create($validated);

        // Redirect to chapter list
        return redirect()->route('chapters.index')
            ->with('success', 'Chapter added successfully!');
    }

    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $books = Book::all();

        return view('admin.chapters.edit', compact('chapter', 'books'));
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'chapter_number' => 'required|integer',
            'chapter_title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $chapter->update($validated);

        return redirect()->route('chapters.index')
            ->with('success', 'Chapter updated successfully');
    }

    public function destroy($id)
    {
        Chapter::destroy($id);

        return redirect()->route('chapters.index')
            ->with('success', 'Chapter deleted');
    }
}
