<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RiviewController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('review.pages.landing-page');

});

Route::get('review.pages.home', [HomeController::class, 'index'])->name('review.pages.home');

Route::get('review.app.statistik', [StatistikController::class, 'index'])->name('review.app.statistik');

Route::get('review.app.profile', ProfileController::class)->middleware('auth')->name('review.app.profile');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/notes', [App\Http\Controllers\HomeController::class, 'notes'])->name('notes');

Route::post('/notes', [NoteController::class, 'store'])->name('note.store');


Route::post('/store', [App\Http\Controllers\HomeController::class, 'store']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/update', [UserProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

Route::get('/chat', [ChatController::class, 'index'])->name('chat')->middleware('auth');

Route::get('/review', [ReviewController::class, 'index'])->name('review.index')->middleware('auth');
