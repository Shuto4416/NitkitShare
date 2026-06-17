<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread; // You MUST import your Model at the top!

class ThreadController extends Controller
{
    // Fetch and display all threads
    public function index()
    {
        // Get all threads from the database, newest first
        $threads = Thread::latest()->get(); 

        // Pass the $threads data to the Blade view (we will build this in Step 4)
        return view('threads.index', compact('threads'));
    }

    // Save a new thread to the database
    public function store(Request $request)
    {
        // 1. Validate the input (prevent empty or overly long thread names)
        $request->validate([
            'name' => 'required|string|max:500',
        ]);

        // 2. Save to the database
        Thread::create([
            'name' => $request->name,
            'user_id' => 1, // Temporary: hardcoded until Auth feature is merged
        ]);

        // 3. Redirect the user back to the thread list page
        return redirect()->route('threads.index');
    }
}