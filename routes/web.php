<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LandingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('review.pages.home', [HomeController::class, 'index'])->name('review.pages.home');
Route::get('review.app.statistik', [StatistikController::class, 'index'])->name('review.app.statistik');
Route::get('review.app.profile', ProfileController::class)->middleware('auth')->name('review.app.profile');
Auth::routes();

// --- Public Routes ---
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

// --- Protected Routes (Require Login) ---
// --- Protected Routes ---
Route::middleware(['auth'])->group(function () {
    // Notes
    Route::get('/notes', [App\Http\Controllers\HomeController::class, 'notes'])->name('notes');
    Route::post('/notes', [NoteController::class, 'store'])->name('note.store');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store']);

    // Profile
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    // Statistics
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
    Route::post('/statistik/download', [StatistikController::class, 'downloadPdf'])->name('statistik.download');

    // AI Chat (Throttled: 10 req/min)
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])
        ->name('chat.send')
        ->middleware('throttle:10,1');
});
