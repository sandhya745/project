<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [HomeController::class, 'index']);

// Authentication Routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Authenticated + Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    /*
     * Profile Management
     */
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    /*
     * Book, Genre, Author Management
     */
    Route::resource('books', BookController::class);
    Route::resource('chapters', ChapterController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('authors', AuthorController::class);

    /*
     * Users / Readers
     */
    Route::get('/users/readers', [UserController::class, 'readers'])->name('users.readers');

    /*
     * Reports
     */
    Route::get('/reports/analytics', [ReportController::class, 'analytics'])->name('reports.analytics');

    /*
     * Notifications
     */
    Route::get('/notifications/logs', [NotificationController::class, 'logs'])->name('notifications.logs');

    /*
     * Settings
     */
    Route::get('/settings/site', [SettingsController::class, 'site'])->name('settings.site');
    Route::get('/settings/backup', [SettingsController::class, 'backup'])->name('settings.backup');
    // routes/web.php
Route::post('/settings/backup/create', [SettingsController::class, 'createBackup'])->name('settings.backup.create');
Route::post('/settings/backup/restore', [SettingsController::class, 'restoreBackup'])->name('settings.backup.restore');

    Route::get('/settings/newsletter', [SettingsController::class, 'newsletter'])->name('settings.newsletter');
    Route::get('/settings/profile', [SettingsController::class, 'profile'])->name('settings.profile'); // renamed to avoid collision
    Route::post('/settings/site', [SettingsController::class, 'updateSite'])->name('settings.updateSite');
    /*
     * Help / Documentation
     */
    Route::get('/help', [HelpController::class, 'index'])->name('help');
});

/*

| Reader Routes (Authenticated)

*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('reader.dashboard');
    })->name('reader.dashboard');
});
    Route::get('/books', [ReaderController::class, 'index'])->name('reader.index');
    Route::get('/books/{book}', [ReaderController::class, 'show'])->name('reader.show');
    Route::get('/books/{book}/chapter/{chapter}', [ReaderController::class, 'read'])->name('reader.read');

    Route::get('/genres', [ReaderController::class, 'genres'])->name('reader.genres');
    Route::get('/genres/{genre}', [ReaderController::class, 'genreBooks'])->name('reader.genre.books');

