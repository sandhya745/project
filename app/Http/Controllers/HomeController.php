<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class HomeController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('welcome', compact('genres'));
    }
}
