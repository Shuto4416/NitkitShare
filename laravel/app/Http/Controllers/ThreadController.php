<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread; // You MUST import your Model at the top!

class ThreadController extends Controller
{
    // Fetch and display all threads
    

    public function index(Request $request)
    {
        // 画像を一緒に取得してN+1問題を防止
        $query = Thread::with('images')->latest();

        // 1. キーワード検索 (Keyword Search: Always works, even if toggle is off)
        $query->when($request->search, function ($q, $search) {
            return $q->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%");
            });
        });

        // 2. 募集中のみ表示 (Active Only: Always works if checked in the dropdown)
        $query->when($request->active_only, function ($q) {
            // ※実際のデータベースの「完了」ステータスを示すカラム名に合わせて変更してください
            return $q->where('status', '!=', '取引完了'); 
        });

        // ==========================================
        // 🌟 マスターフィルタースイッチ (Master Filter Toggle)
        // トグルが「ON（緑）」の時だけ、この中身が実行されます！
        // ==========================================
        if ($request->has('use_filters')) {
            
            // カテゴリ (Category)
            $query->when($request->category, function ($q, $category) {
                return $q->where('category', $category);
            });

            // 学年 (Grade)
            $query->when($request->grade_year, function ($q, $grade) {
                return $q->where('grade_year', $grade);
            });

            // コース (Department)
            $query->when($request->department, function ($q, $department) {
                return $q->where('department', $department);
            });

            // 種別 (Course Type)
            $query->when($request->course_type, function ($q, $type) {
                return $q->where('course_type', $type);
            });

            // 投稿時期 (Date Range)
            $query->when($request->date_from, function ($q, $date_from) {
                return $q->whereDate('created_at', '>=', $date_from);
            });

            $query->when($request->date_to, function ($q, $date_to) {
                return $q->whereDate('created_at', '<=', $date_to);
            });

            // 状態・スキル (Conditions & Skills - JSON Array Search)
            $query->when($request->conditions, function ($q, $conditions) {
                if (is_array($conditions)) {
                    return $q->where(function ($query) use ($conditions) {
                        foreach ($conditions as $condition) {
                            $query->orWhere('conditions', 'LIKE', "%{$condition}%"); 
                        }
                    });
                }
            });
        }
        // ==========================================
        // マスターフィルター ここまで
        // ==========================================

        // ページネーション (withQueryString でURLパラメータを保持)
        $threads = $query->paginate(12)->withQueryString();

        return view('threads.index', compact('threads'));
    }

    // Save a new thread to the database
    // 新規スレッドを保存する処理 / Logic to save a new thread

    public function store(Request $request)
    {
        // 1. Validation 
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
            'skills' => 'nullable|array',
            'custom_skills' => 'nullable|array',
        ]);

        // 2. Prepare Data (Merge Conditions and Skills together)
        $existingConditions = $request->input('conditions', []);
        $presetSkills = $request->input('skills', []);
        $customSkills = array_filter($request->input('custom_skills', [])); // Remove empty strings
        
        // Combine everything into one master array
        $finalConditionsData = array_merge($existingConditions, $presetSkills, $customSkills);

        // 3. Save the Thread (Once!)
        $thread = Thread::create([
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'grade_year' => $request->grade_year,
            'department' => $request->department,
            'course_type' => $request->course_type,
            // Pass the merged array directly!
            'conditions' => $finalConditionsData, 
            'description' => $request->description,
            'user_id' => 1, 
        ]);

        // 4. Save Multiple Images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $uploadedFile) {
                $path = $uploadedFile->store('images', 'public');
                
                \App\Models\ThreadImage::create([
                    'thread_id' => $thread->id, // This works now because $thread exists!
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