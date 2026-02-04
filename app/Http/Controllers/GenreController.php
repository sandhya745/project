<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
     // Show form to create new genre
    public function create()
    {
        return view('genres.create'); // we'll create this blade next
    }

    // Store the new genre
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:genres,name',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);
    if ($request->return_to) {
        return redirect($request->return_to)->with('success', 'Genre added');
    }

    return redirect()->route('genres.index')->with('success', 'Genre added');

    }
 // List genres
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    // Edit form
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update(['name' => $request->name]);

        return redirect()->route('genres.index')
            ->with('success', 'Genre updated successfully');
    }

    // Delete
    public function destroy(Genre $genre)
{
    if ($genre->books()->count() > 0) {
        return back()->with('error', 'Cannot delete genre. Books still use it.');
    }

    $genre->delete();
    return back()->with('success', 'Genre deleted!');
}

}
