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
            'author_name' => 'required',
            'bio' => 'nullable',
        ]);

        Author::create($request->only('author_name', 'bio'));

        return redirect()->route('book.create')->with('success', 'Author added! Now select it from the dropdown.');
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

}

