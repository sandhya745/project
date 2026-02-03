<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GenreController;
// Welcome page
//Route::get('/', function () {
   // return view('welcome');
//});
Route::get('/', [HomeController::class, 'index']);

// Books routes
Route::prefix('books')->group(function () {

    // List all books (optionally by genre)
    Route::get('/', [BookController::class, 'index'])->name('book.list');

    // Create & Store
    Route::get('/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/', [BookController::class, 'store'])->name('book.store');

    // Edit & Update
    Route::get('{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('{id}', [BookController::class, 'update'])->name('book.update');

    // Delete
    Route::delete('{id}', [BookController::class, 'destroy'])->name('book.destroy');

    // Show single book
    Route::get('{book}', [BookController::class, 'show'])->name('book.detail');
});

Route::prefix('genres')->group(function () {
    // Show the form to add a new genre
Route::get('/create', [GenreController::class, 'create'])->name('genres.create');

// Store new genre
Route::post('/', [GenreController::class, 'store'])->name('genres.store');

    Route::get('/', [GenreController::class, 'index'])->name('genres.index');
    Route::get('{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('{id}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('{id}', [GenreController::class, 'destroy'])->name('genres.destroy');
});
