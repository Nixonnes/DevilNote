<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [NoteController::class, 'index'])->middleware(['auth', 'verified'])->name('notes.index');

Route::get('notes/create', [NoteController::class, 'create'])->middleware(['auth', 'verified'])->name('notes.create');
Route::post('/notes/create', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{id}', [NoteController::class, 'show'])->middleware(['auth', 'verified'])->name('notes.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
