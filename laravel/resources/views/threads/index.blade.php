<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NitkitShare - 掲示板</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">掲示板 (Threads)</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-8 border border-gray-200">
            <form action="{{ route('threads.store') }}" method="POST">
                @csrf 
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">新しいスレッドを作成</label>
                    <input type="text" name="name" id="name" required
                           class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="スレッドのタイトルを入力してください...">
                    
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" class="bg-blue-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    作成する (Create)
                </button>
            </form>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4 text-gray-700">最新のスレッド</h2>
            
            <div class="space-y-4">
                @foreach($threads as $thread)
                    <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-blue-500 hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $thread->name }}</h3>
                        
                        <div class="text-sm text-gray-500 mt-2 flex justify-between">
                            <span>作成者: User ID {{ $thread->user_id }}</span>
                            <span>{{ $thread->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>
                @endforeach

                @if($threads->isEmpty())
                    <div class="text-center text-gray-500 p-6 bg-white rounded-lg border border-dashed border-gray-300">
                        まだスレッドがありません。最初のスレッドを作成してみましょう！
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>