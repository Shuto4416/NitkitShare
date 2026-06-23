<!-- 共通レイアウトの定義 / Definition of the master layout -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 各ページのタイトルを埋め込む / Inject the title for each page dynamically -->
    <title>@yield('title', 'NitKitシェア')</title> 
    <!-- Tailwind CSSの読み込み / Load Tailwind CSS framework -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f2f2f2] text-gray-800 font-sans min-h-screen flex flex-col">

    <!-- ヘッダー部分 (全ページ共通) / Header section (Shared across all pages) -->
    <header class="bg-white border-b-2 border-gray-300 px-6 py-3 flex justify-between items-center sticky top-0 z-50">
        
        <!-- ロゴエリア / Logo area -->
        <div class="flex items-center space-x-2">
            <a href="{{ route('threads.index') }}" class="text-3xl font-extrabold tracking-tighter italic hover:text-gray-600 transition">
                NitKitシェア
            </a>
        </div>
        
        <!-- 右側のナビゲーションボタン / Right-side navigation buttons -->
        <div class="flex items-center space-x-4">
            
            <!-- 新規投稿ページへのリンク / Link to the Create New Post page -->
            <a href="{{ route('threads.create') }}" class="bg-black text-white px-4 py-2 font-bold rounded-md hover:bg-gray-800 transition block text-center">
                +新規投稿
            </a>
            
            <!-- マイ取引ボタン / My Transactions button -->
            <button class="bg-[#8faadc] text-black px-4 py-2 font-bold rounded-md border border-black hover:bg-blue-400 transition">
                マイ取引
            </button>
            
            <!-- ユーザーアイコン / User profile icon -->
            <div class="w-10 h-10 rounded-full border border-black flex items-center justify-center font-bold bg-white">
                網
            </div>
        </div>
    </header>

    <!-- メインコンテンツ (各ページの中身がここに入ります) / Main content (Individual page content goes here) -->
    <main class="flex-grow">
        @yield('content')
    </main>

</body>
</html>