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


Route::get('notes/create', [NoteController::class, 'create'])->middleware(['auth', 'verified'])->name('notes.create');
Route::post('/notes/create', [NoteController::class, 'store'])->middleware(['auth','verified'])->name('notes.store');
Route::get('/notes/{id}', [NoteController::class, 'show'])->middleware(['auth', 'verified'])->name('notes.show')->whereNumber('id');
Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->middleware(['auth', 'verified'])->name('notes.edit');
Route::patch('/notes/{id}', [NoteController::class, 'update'])->middleware(['auth', 'verified'])->name('notes.update');
Route::get('{user_id}/notes', [NoteController::class, 'showUserNotes'])->middleware(['auth', 'verified'])->name('user.notes');
Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->middleware(['auth', 'verified'])->name('notes.destroy');

Route::post('/notes/{id}/comments', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comments.store');
Route::post('/notes/{id}/like', [LikeController::class, 'like'])->middleware(['auth', 'verified'])->name('like.note');
Route::delete('/notes/{id}/unlike', [LikeController::class, 'unlike'])->middleware(['auth', 'verified'])->name('unlike.note');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
require __DIR__.'/auth.php';
