<!-- 共通レイアウトを継承する / Extend the master layout -->
@extends('layouts.app')

<!-- ページのタイトルを設定 / Set the page title -->
@section('title', 'ホーム - NitKitシェア')

<!-- メインコンテンツ部分 / Main content section -->
@section('content')
<div class="max-w-6xl mx-auto p-6">
    
    <!-- 検索＆フィルター部分 / Search & Filter section -->
    <div class="mb-8">
        <h2 class="text-lg font-bold mb-2">検索 (Search)</h2>
        
        <!-- 検索バー / Search input bar -->
        <input type="text" placeholder="アイテムを検索 (Search items)" 
               class="w-full border border-gray-400 px-4 py-2 rounded-md mb-3 focus:outline-none focus:border-blue-500">
        
        <!-- フィルターオプション / Filter dropdowns -->
        <div class="flex items-center space-x-3">
            <select class="border border-gray-400 px-4 py-2 rounded-md bg-white w-48 text-gray-600">
                <option>カテゴリ (Category)</option>
            </select>
            <select class="border border-gray-400 px-4 py-2 rounded-md bg-white w-48 text-gray-600">
                <option>ステータス (Status)</option>
            </select>
            
            <div class="flex items-center space-x-2 ml-4">
                <span class="font-bold">フィルター (Filter)</span>
                <!-- トグルスイッチ / Toggle UI switch -->
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
        <div class="bg-white border border-[#1e2a5e] rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
            
            <!-- 画像プレースホルダー / Image placeholder area -->
            <div class="h-32 bg-[#e2e8f0] border-b border-[#1e2a5e]"></div>
            
            <!-- カードの中身 / Card body content -->
            <div class="p-3 flex-grow flex flex-col justify-between">
                
                <!-- スレッドのタイトル / Thread title -->
                <h3 class="font-bold text-sm mb-3 truncate">{{ $thread->name }}</h3>
                
                <!-- タグ（現在ハードコード） / Tags (Currently hardcoded) -->
                <div class="flex space-x-2 text-xs font-bold">
                    <span class="bg-[#ffff00] border border-black rounded-full px-3 py-1">情報</span>
                    <span class="bg-white border border-black rounded-full px-3 py-1">5年</span>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection