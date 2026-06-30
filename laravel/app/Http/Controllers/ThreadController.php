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
    // 新規スレッドを保存する処理 / Logic to save a new thread
    public function store(Request $request)
    {
        // 1. データの検証 / Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'category' => 'required|string',
            'grade_year' => 'nullable|string',
            'department' => 'nullable|string',
            'course_type' => 'nullable|string',
            'conditions' => 'nullable|array', // 配列として受け取る
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 最大2MBの画像のみ許可 (Max 2MB)
        ]);

        // 2. 画像の保存処理 
        // 2. Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // 'public/images' フォルダに保存し、そのパスを取得します
            // Store the image in 'public/images' and get the file path
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // 3. データベースに保存 / Save to database
        Thread::create([
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'grade_year' => $request->grade_year,
            'department' => $request->department,
            'course_type' => $request->course_type,
            'conditions' => $request->conditions, // チェックボックスの配列がそのまま保存されます
            'description' => $request->description,
            'image_path' => $imagePath, // 画像のパスを保存 (Save the image path)
            'user_id' => 1, // 仮のユーザーID
        ]);

        // 4. 一覧ページへリダイレクト / Redirect to home
        return redirect()->route('threads.index');
    }

    // Show the creation form
    public function create()
    {
        return view('threads.create');
    }
}