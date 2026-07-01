<?php

use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController; // Import your controller

Route::get('/', function () {
    return view('welcome');
});

// --- Add your Thread Routes Here ---

// When a user visits /threads, run the index() method
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');

// When a user submits the form to /threads, run the store() method
Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
// Show the form to create a new thread
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');

//表示用
Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
//データ追加用
Route::post('/friends', [FriendController::class, 'store'])->name('friends.store');

// Show a specific thread
Route::get('/threads/{thread}', [App\Http\Controllers\ThreadController::class, 'show']);
//
Route::get('/threads/{thread}', [App\Http\Controllers\ThreadController::class, 'show'])->name('threads.show');
