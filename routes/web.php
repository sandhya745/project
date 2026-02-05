<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
// Welcome page
//Route::get('/', function () {
   // return view('welcome');
//});

Route::get('/', [HomeController::class, 'index']);

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('book.list');
    Route::get('/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/', [BookController::class, 'store'])->name('book.store');

    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('book.destroy');

    Route::get('/{book}', [BookController::class, 'show'])->name('book.detail');
});

Route::prefix('genres')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');
});

Route::prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('/', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

    });
