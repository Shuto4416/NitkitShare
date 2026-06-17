<?php

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