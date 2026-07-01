<!-- 共通レイアウトを継承する / Extend the master layout -->
@extends('layouts.app')

<!-- ページのタイトルを設定 / Set the page title -->
@section('title', 'ホーム - NitKitシェア')

<!-- メインコンテンツ部分 / Main content section -->
@section('content')
<div class="max-w-6xl mx-auto p-6">
    
    <div class="mb-8">
        <h2 class="text-lg font-bold mb-2">検索</h2>
        
        <input type="text" placeholder="アイテムを検索" 
               class="w-full border border-gray-400 px-4 py-2 rounded-md mb-3 focus:outline-none focus:border-blue-500">
        
        <div class="flex items-center space-x-3 relative">
            
            <div class="relative group">
                <button class="border border-gray-400 px-4 py-2 rounded-md bg-white w-48 text-left flex justify-between items-center text-gray-600">
                    カテゴリ <span class="text-xs">▽</span>
                </button>
                
                <div class="absolute left-0 top-11 w-64 bg-white border border-gray-400 rounded-md shadow-lg z-50 p-4 hidden group-hover:block">
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 mb-1">種類：</p>
                        <div class="flex flex-wrap gap-2">
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-[#e2e8f0]">教科書</button>
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-white">参考書</button>
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-[#e2e8f0]">スキル</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 mb-1">学年：</p>
                        <div class="flex flex-wrap gap-2">
                            <button class="border border-black rounded-full w-10 h-8 flex items-center justify-center text-xs font-bold bg-white">1年</button>
                            <button class="border border-black rounded-full w-10 h-8 flex items-center justify-center text-xs font-bold bg-white">2年</button>
                            <button class="border border-black rounded-full w-10 h-8 flex items-center justify-center text-xs font-bold bg-white">3年</button>
                            <button class="border border-black rounded-full w-10 h-8 flex items-center justify-center text-xs font-bold bg-white">4年</button>
                            <button class="border border-black rounded-full w-10 h-8 flex items-center justify-center text-xs font-bold bg-white">5年</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 mb-1">コース：</p>
                        <div class="flex flex-wrap gap-2">
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-[#8faadc]">機械</button>
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-white">知能</button>
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-[#a9d18e]">電気</button>
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-[#ffff00]">情報</button>
                            <button class="border border-black rounded-full px-3 py-1 text-xs font-bold bg-[#ff0000] text-white">化学</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative group">
                <button class="border border-gray-400 px-4 py-2 rounded-md bg-white w-48 text-left flex justify-between items-center text-gray-600">
                    ステータス <span class="text-xs">▽</span>
                </button>
                
                <div class="absolute left-0 top-11 w-64 bg-white border border-gray-400 rounded-md shadow-lg z-50 p-4 hidden group-hover:block">
                    <p class="text-xs text-gray-600 mb-1">投稿時期：</p>
                    <div class="flex items-center space-x-2 mb-3">
                        <input type="text" class="w-full border border-black rounded bg-[#e2e8f0] h-6">
                        <span>~</span>
                        <input type="text" class="w-full border border-black rounded bg-[#e2e8f0] h-6">
                    </div>
                    
                    <p class="text-xs text-gray-600 mb-1">状態：</p>
                    <div class="flex flex-col space-y-2">
                        <label class="flex items-center space-x-2 text-xs font-bold">
                            <input type="checkbox" class="w-4 h-4 border-black">
                            <span class="border border-black rounded-full px-3 py-1 bg-white">未使用に近い</span>
                        </label>
                        <label class="flex items-center space-x-2 text-xs font-bold">
                            <input type="checkbox" class="w-4 h-4 border-black">
                            <span class="border border-black rounded-full px-3 py-1 bg-white">傷・汚れ有</span>
                        </label>
                        <label class="flex items-center space-x-2 text-xs font-bold">
                            <input type="checkbox" class="w-4 h-4 border-black">
                            <span class="border border-black rounded-full px-3 py-1 bg-white">書き込み有</span>
                        </label>
                        <label class="flex items-center space-x-2 text-xs font-bold">
                            <input type="checkbox" class="w-4 h-4 border-black">
                            <span class="border border-black rounded-full px-3 py-1 bg-white">欠品有</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center space-x-2 ml-4">
                <span class="font-bold">フィルター</span>
                <div class="w-14 h-7 bg-[#7ab756] rounded-full border border-black relative cursor-pointer">
                    <div class="w-6 h-6 bg-white rounded-full border border-black absolute right-0 top-0 mt-[1px] mr-[1px]"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- アイテム一覧（グリッド） / Items list (Grid layout) -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        <!-- データベースから取得したスレッドをループ表示 / Loop through threads from the database -->
        @foreach($threads as $thread)
        
        <a href="{{ route('threads.show', $thread->id) }}" class="bg-white border border-[#1e2a5e] rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col block cursor-pointer">
            
            <div class="h-32 border-b border-[#1e2a5e] bg-gray-100 flex items-center justify-center overflow-hidden">
    @if($thread->image_path)
        <img src="{{ asset('storage/' . $thread->image_path) }}" alt="Item Image" class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-[#e2e8f0]"></div>
    @endif
            </div>
            
            <div class="p-3 flex-grow flex flex-col justify-between">
                
                <h3 class="font-bold text-sm mb-3 truncate">{{ $thread->name }}（{{ $thread->type }}）</h3>
                
                <div class="flex flex-wrap gap-2 text-xs font-bold">
                    
                    <span class="bg-[#e2e8f0] border border-black rounded-full px-3 py-1">
                        {{ $thread->category }}
                    </span>

                    @if($thread->department)
                        @php
                            // 学科ごとに背景色と文字色を判定 / Determine colors based on department
                            $deptColor = match($thread->department) {
                                '情報' => 'bg-[#ffff00] text-black', // Yellow
                                '機械' => 'bg-[#8faadc] text-black', // Blue
                                '電気' => 'bg-[#a9d18e] text-black', // Green
                                '化学' => 'bg-[#ff0000] text-white', // Red
                                default => 'bg-white text-black',    // Default (e.g., 知能)
                            };
                        @endphp
                        <span class="{{ $deptColor }} border border-black rounded-full px-3 py-1">
                            {{ $thread->department }}
                        </span>
                    @endif

                    @if($thread->grade_year)
                        <span class="bg-white border border-black rounded-full px-3 py-1">
                            {{ $thread->grade_year }}
                        </span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>
@endsection