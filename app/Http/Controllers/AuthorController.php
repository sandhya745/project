<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'author_name' => 'required|string|max:255',
        'bio' => 'nullable|string',
    ]);

    $author = Author::create(
        $request->only('author_name', 'bio')
    );

    // If coming from Book Create
    if ($request->filled('return_to')) {
        return redirect($request->return_to)
            ->with('success', 'Author added! Now select it from the dropdown.')
            ->with('new_author_id', $author->id)
            ->withInput();
    }

    // Normal Author creation
    return redirect()
        ->route('authors.index')
        ->with('success', 'Author added successfully.');
}


    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

   public function update(Request $request, Author $author)
{
    $request->validate([
        'author_name' => 'required|string|max:255',
        'bio' => 'nullable|string'
    ]);

    $author->update($request->only('author_name', 'bio'));
    return redirect()->route('authors.index')->with('success', 'Author updated');
}


   public function destroy(Author $author)
{
    if ($author->books()->count() > 0) {
        return redirect()->route('authors.index')
            ->with('error', 'Cannot delete author. Books are still assigned.');
    }

    $author->delete();

    return redirect()->route('authors.index')
        ->with('success', 'Author deleted.');
}
public function show(Author $author)
{
    // Load author with their books
    $author->load('books');

    return view('authors.show', compact('author'));
}

}

