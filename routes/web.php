<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [NoteController::class, 'index'])->middleware(['auth', 'verified'])->name('notes.index');
// Notes
Route::prefix('notes')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/create', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/{id}', [NoteController::class, 'show'])->name('notes.show')->whereNumber('id');
    Route::get('/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::patch('/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::post('/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/{id}/like', [LikeController::class, 'like'])->name('like.note');
});


Route::get('{user_id}/notes', [NoteController::class, 'showUserNotes'])->middleware(['auth', 'verified'])->name('user.notes');

Route::get('/categories', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('categories.index');
Route::get('/categories/search', [CategoryController::class, 'search'])->middleware(['auth', 'verified'])->name('categories.search');

Route::delete('/notes/{id}/unlike', [LikeController::class, 'unlike'])->middleware(['auth', 'verified'])->name('unlike.note');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
require __DIR__.'/auth.php';
