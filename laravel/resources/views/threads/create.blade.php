<!-- 共通レイアウトを継承する / Extend the master layout -->
@extends('layouts.app')

<!-- ページのタイトルを設定 / Set the page title -->
@section('title', '新規投稿 - NitKitシェア')

<!-- メインコンテンツ部分 / Main content section -->
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 mt-8 rounded-xl shadow-sm border border-[#1e2a5e]">
    
    <!-- フォームのタイトル / Form header -->
    <h1 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">アイテムを新規投稿 (Create New Item)</h1>

    <!-- 新規作成フォーム (POSTメソッドで送信) / Form submission targeting the store route -->
    <form action="{{ route('threads.store') }}" method="POST">
        
        <!-- セキュリティ対策のCSRFトークン (Laravelでは必須) / Laravel security token (Required) -->
        @csrf
        
        <div class="mb-6">
            <!-- タイトルの入力ラベル / Title input label -->
            <label for="name" class="block text-sm font-bold mb-2">タイトル (Title)</label>
            
            <!-- タイトルのテキスト入力欄 / Title text input field -->
            <input type="text" name="name" id="name" required
                   class="w-full border border-gray-400 p-3 rounded-md focus:outline-none focus:border-blue-500" 
                   placeholder="例: PHP超入門（提供）">
            
            <!-- エラーメッセージの表示 / Display validation errors if any -->
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- ボタンエリア / Form action buttons -->
        <div class="flex justify-between items-center mt-8">
            
            <!-- キャンセルして一覧に戻るリンク / Link to cancel and go back -->
            <a href="{{ route('threads.index') }}" class="text-gray-500 hover:underline font-bold">キャンセル (Cancel)</a>
            
            <!-- データを保存する送信ボタン / Submit button to save data -->
            <button type="submit" class="bg-black text-white font-bold px-8 py-3 rounded-md hover:bg-gray-800 transition">
                投稿する (Submit)
            </button>
        </div>
    </form>
</div>
@endsection