@extends('layouts.app')

@section('title', '新規投稿 - NitKitシェア')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 mt-8 rounded-xl shadow-sm border border-[#1e2a5e] mb-12">
    
    <h1 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">アイテムを新規投稿 (Create New Item)</h1>

    <form action="{{ route('threads.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">タイトル (Title)</label>
            <input type="text" name="name" required class="w-full border border-gray-400 p-2 rounded-md" placeholder="例: TOEIC BRIDGE 参考書 2冊セット">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">投稿タイプ (Type)</label>
            <select name="type" class="w-full border border-gray-400 p-2 rounded-md bg-white">
                <option value="提供">提供 (Offer)</option>
                <option value="募集">募集 (Request)</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-bold mb-2">種類 (Category)</label>
                <select name="category" class="w-full border border-gray-400 p-2 rounded-md bg-white">
                    <option value="教科書">教科書</option>
                    <option value="参考書">参考書</option>
                    <option value="スキル">スキル</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">学年 (Grade)</label>
                <select name="grade_year" class="w-full border border-gray-400 p-2 rounded-md bg-white">
                    <option value="">指定なし</option>
                    <option value="1年">1年</option>
                    <option value="2年">2年</option>
                    <option value="3年">3年</option>
                    <option value="4年">4年</option>
                    <option value="5年">5年</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">コース (Course)</label>
                <select name="department" class="w-full border border-gray-400 p-2 rounded-md bg-white">
                    <option value="">指定なし</option>
                    <option value="機械">機械</option>
                    <option value="知能">知能</option>
                    <option value="電気">電気</option>
                    <option value="情報">情報</option>
                    <option value="化学">化学</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">種別 (Type)</label>
                <select name="course_type" class="w-full border border-gray-400 p-2 rounded-md bg-white">
                    <option value="">指定なし</option>
                    <option value="一般">一般</option>
                    <option value="専門">専門</option>
                    <option value="選択">選択</option>
                </select>
            </div>
        </div>

        <div class="mb-6 border-t border-gray-200 pt-4">
            <label class="block text-sm font-bold mb-3">状態 (Condition - 複数選択可)</label>
            <div class="flex flex-wrap gap-4">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="conditions[]" value="未使用に近い" class="w-4 h-4">
                    <span class="text-sm">未使用に近い</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="conditions[]" value="傷・汚れ有" class="w-4 h-4">
                    <span class="text-sm">傷・汚れ有</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="conditions[]" value="書き込み有" class="w-4 h-4">
                    <span class="text-sm">書き込み有</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="conditions[]" value="欠品有" class="w-4 h-4">
                    <span class="text-sm">欠品有</span>
                </label>
            </div>
        </div>

        <div class="mb-6 border-t border-gray-200 pt-4">
            <label class="block text-sm font-bold mb-2">説明文 (Description)</label>
            <textarea name="description" rows="4" class="w-full border border-gray-400 p-3 rounded-md focus:outline-none focus:border-blue-500" placeholder="例: テストの用紙が欠品しています。"></textarea>
        </div>

        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('threads.index') }}" class="text-gray-500 hover:underline font-bold">キャンセル (Cancel)</a>
            <button type="submit" class="bg-black text-white font-bold px-8 py-3 rounded-md hover:bg-gray-800 transition">
                投稿する (Submit)
            </button>
        </div>
    </form>
</div>
@endsection