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

        return redirect()->route('genres.index')->with('success', 'Genre added successfully!');
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
    public function destroy($id)
    {
        Genre::findOrFail($id)->delete();

        return redirect()->route('genres.index')
            ->with('success', 'Genre deleted successfully');
    }
}
