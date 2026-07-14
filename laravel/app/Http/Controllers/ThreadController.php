<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread; // You MUST import your Model at the top!

class ThreadController extends Controller
{
    // Fetch and display all threads
    public function index()
    {
        // Add 'with('images')' to grab the images at the same time as the threads!
        $threads = Thread::with('images')->latest()->get();

        // Pass the $threads data to the Blade view (we will build this in Step 4)
        return view('threads.index', compact('threads'));
    }

    // Save a new thread to the database
    // 新規スレッドを保存する処理 / Logic to save a new thread

    public function store(Request $request)
    {
        // 1. Validation (Notice the 'image.*' to validate each file in the array)
        // バリデーション 
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'category' => 'required|string',
            'grade_year' => 'nullable|string',
            'department' => 'nullable|string',
            'course_type' => 'nullable|string',
            'conditions' => 'nullable|array',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // 2. Save the Thread first (We need the $thread variable to get its ID)
        // スレッドを保存
        $thread = Thread::create([
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'grade_year' => $request->grade_year,
            'department' => $request->department,
            'course_type' => $request->course_type,
            'conditions' => $request->conditions,
            'description' => $request->description,
            'user_id' => 1, 
        ]);

        // 3. Loop through and save multiple images
        // 画像をループして保存
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $uploadedFile) {
                // Store the file in public/images
                $path = $uploadedFile->store('images', 'public');
                // Save the path to the thread_images table, linked to this thread's ID
                \App\Models\ThreadImage::create([
                    'thread_id' => $thread->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('threads.index');
    }


    // Show a single thread detail page
    public function show($id)
    {
        // Find the thread by its ID, and load its images to prevent N+1 queries
        $thread = Thread::with('images')->findOrFail($id);
        // Pass the $thread variable to the detail view
        return view('threads.show', compact('thread'));
    }
    

    // Show the creation form
    public function create()
    {
        return view('threads.create');
    }
}