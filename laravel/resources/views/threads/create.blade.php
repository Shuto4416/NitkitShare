@extends('layouts.app')

@section('title', '新規投稿 - NitKitシェア')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 mt-8 rounded-xl shadow-sm border border-[#1e2a5e] mb-12">
    
    <h1 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">アイテムを新規投稿 (Create New Item)</h1>

    <form action="{{ route('threads.store') }}" method="POST" enctype="multipart/form-data">
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
            <label class="block text-sm font-bold mb-3">スキル要件 (Skills)</label>
            
            <div class="mb-3">
                <p class="text-xs text-gray-600 mb-2">依頼者のスキル：</p>
                <div class="flex flex-wrap gap-2 items-center">
                    @foreach(['初学者', '一部自律', '習得済み', '熟練者'] as $skill)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="peer sr-only">
                        <span class="bg-white border border-black rounded-full px-3 py-1 text-xs font-bold peer-checked:bg-[#e2e8f0] peer-checked:ring-2 peer-checked:ring-black transition">{{ $skill }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <p class="text-xs text-gray-600 mb-2">求められているスキル：</p>
                <div class="flex flex-wrap gap-2 items-center">
                    @foreach(['指導者', '開発協力'] as $skill)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="peer sr-only">
                        <span class="bg-white border border-black rounded-full px-3 py-1 text-xs font-bold peer-checked:bg-[#e2e8f0] peer-checked:ring-2 peer-checked:ring-black transition">{{ $skill }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mt-3 flex items-center space-x-2">
                <span class="text-xl font-bold text-gray-400">+</span>
                <input type="text" name="custom_skills[]" placeholder="独自のスキルを追加 (例: C++, Laravel)" 
                    class="border border-gray-400 rounded-md px-3 py-1 text-sm w-64 focus:outline-none focus:border-[#1e2a5e]">
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
            <label class="block text-sm font-bold mb-2">商品画像 (Multiple Images)</label>
            
            <input type="file" id="imageInput" name="image[]" accept="image/*" multiple 
                class="w-full border border-gray-400 p-2 rounded-md bg-white">
            
            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4"></div>
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

<script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    // We use DataTransfer to manage the files array programmatically
    let dataTransfer = new DataTransfer();
    // Listen for when files are selected
    imageInput.addEventListener('change', function(event) {
        // Add newly selected files to our DataTransfer object
        Array.from(imageInput.files).forEach(file => {
            dataTransfer.items.add(file);
        });
        // Update the input with the new list
        imageInput.files = dataTransfer.files;
        
        // Render the UI
        renderPreviews();
    });

    function renderPreviews() {
        // Clear the container first
        previewContainer.innerHTML = '';

        // Loop through the current files and create thumbnails
        Array.from(imageInput.files).forEach((file, index) => {
            // Create an object URL to show the image instantly
            const objectUrl = URL.createObjectURL(file);

            // Create the HTML for the thumbnail and delete button
            const previewHtml = `
                <div class="relative w-full h-32 border border-gray-300 rounded-md overflow-hidden shadow-sm group">
                    <img src="${objectUrl}" class="w-full h-full object-cover">
                    
                    <button type="button" 
                            onclick="removeImage(${index})" 
                            class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow-md hover:bg-red-700 transition-colors">
                        X
                    </button>
                </div>
            `;
            
            // Add it to the container
            previewContainer.insertAdjacentHTML('beforeend', previewHtml);
        });
    }

    // Function to remove a specific image when 'X' is clicked
    function removeImage(indexToRemove) {
        // Create a fresh DataTransfer object
        const newDataTransfer = new DataTransfer();
        
        // Loop through current files, keep all EXCEPT the one we want to remove
        Array.from(imageInput.files).forEach((file, index) => {
            if (index !== indexToRemove) {
                newDataTransfer.items.add(file);
            }
        });

        // Update our main DataTransfer and the actual HTML input
        dataTransfer = newDataTransfer;
        imageInput.files = dataTransfer.files;

        // Re-render the thumbnails
        renderPreviews();
    }
</script>
@endsection