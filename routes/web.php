<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Route;

// Welcome page
// Route::get('/', function () {
// return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // BOOK MANAGEMENT
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('book.list');
        Route::get('/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/', [BookController::class, 'store'])->name('book.store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('book.destroy');
        Route::get('/{book}', [BookController::class, 'show'])->name('book.detail');
    });

    // GENRES
    Route::prefix('genres')->group(function () {
        Route::get('/', [GenreController::class, 'index'])->name('genres.index');
        Route::get('/create', [GenreController::class, 'create'])->name('genres.create');
        Route::post('/', [GenreController::class, 'store'])->name('genres.store');
        Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        Route::put('/{genre}', [GenreController::class, 'update'])->name('genres.update');
        Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');
    });

    // AUTHORS
    Route::prefix('authors')->group(function () {
        Route::get('/', [AuthorController::class, 'index'])->name('authors.index');
        Route::get('/create', [AuthorController::class, 'create'])->name('authors.create');
        Route::post('/', [AuthorController::class, 'store'])->name('authors.store');
        Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
        Route::put('/{author}', [AuthorController::class, 'update'])->name('authors.update');
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
        Route::get('/{author}', [AuthorController::class, 'show'])->name('authors.show');
    });

});

// for readers
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('reader.dashboard');
})->name('reader.dashboard');

Route::get('/books', [ReaderController::class, 'index'])->name('reader.index');
Route::get('/books/{book}', [ReaderController::class, 'show'])->name('reader.show');
Route::get('/books/{book}/chapter/{chapter}', [ReaderController::class, 'read'])->name('reader.read');

Route::get('/genres', [ReaderController::class, 'genres'])->name('reader.genres');
Route::get('/genres/{genre}', [ReaderController::class, 'genreBooks'])->name('reader.genre.books');

/*
  *Auth Routes
*/

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
