<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // BOOK MANAGEMENT
    Route::resource('books', BookController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('authors', AuthorController::class);

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
