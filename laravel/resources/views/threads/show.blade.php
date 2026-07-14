@extends('layouts.app')

@section('title', $thread->name . ' - NitKitシェア')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-6">
    
    <div class="flex justify-between items-center mb-4 px-2">
        <a href="{{ route('threads.index') }}" class="text-3xl font-extrabold hover:text-gray-500 transition">＜</a>
        <button class="text-3xl font-extrabold hover:text-gray-500">⋮</button>
    </div>

    @if($thread->image_path)
        <div class="w-full h-64 md:h-80 rounded-t-3xl border-2 border-[#1e2a5e] mb-[-40px] relative z-0 overflow-hidden bg-gray-100">
            <img src="{{ asset('storage/' . $thread->image_path) }}" alt="{{ $thread->name }}" class="w-full h-full object-contain">
        </div>
    @else
        <div class="w-full h-64 md:h-80 bg-gradient-to-r from-red-500 to-blue-600 rounded-t-3xl border-2 border-[#1e2a5e] mb-[-40px] relative z-0">
        </div>
    @endif

    <div class="bg-white border-2 border-[#1e2a5e] rounded-3xl p-6 relative z-10 shadow-md flex flex-col md:flex-row">
        
        <div class="w-full md:w-28 flex flex-col items-center mb-6 md:mb-0 md:mr-6 flex-shrink-0">
            <div class="w-20 h-20 rounded-full border-2 border-[#1e2a5e] overflow-hidden mb-2">
                <img src="https://ui-avatars.com/api/?name=User&background=8faadc&color=fff" alt="User" class="w-full h-full object-cover">
            </div>
            <span class="font-bold text-sm text-center">5400さん</span>
        </div>

        <div class="flex-grow w-full min-w-0">
            
            <div class="flex flex-col md:flex-row justify-between items-start mb-4">
                <h1 class="text-xl md:text-2xl font-bold mb-2 md:mb-0">{{ $thread->name }}（{{ $thread->type }}）</h1>
                <span class="text-gray-400 text-sm font-bold flex-shrink-0">{{ $thread->created_at->format('Y/m/d') }}</span>
            </div>

            <div class="flex flex-wrap gap-2 mb-6 text-sm font-bold">
                <span class="border border-black rounded-full px-4 py-1">{{ $thread->category }}</span>
                @if($thread->department)
                    <span class="border border-black rounded-full px-4 py-1">{{ $thread->department }}</span>
                @endif
                
                @if($thread->course_type)
                    <span class="border border-black rounded-full px-4 py-1">{{ $thread->course_type }}</span>
                @endif
            </div>

            @if(!empty($thread->conditions))
            <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-xs text-gray-500 mb-2">アイテムの状態 / 必要なスキル (Conditions & Skills):</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($thread->conditions as $condition)
                        <span class="bg-white border border-gray-400 rounded-full px-3 py-1 text-xs font-bold text-gray-700 shadow-sm">
                            {{ $condition }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif


            <!-- resources/views/threads/show.blade.php -->

            <div class="mb-8 w-full overflow-hidden">
                <h2 class="text-lg font-bold mb-4">商品画像 (Images)</h2>
                @if($thread->images->isNotEmpty())
                    <!-- CSS Grid to display images nicely -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Loop through ALL images --}}
                        @foreach($thread->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="Item Image" 
                                onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}')"
                                class="w-full h-64 object-cover rounded-md border border-gray-300 shadow-sm cursor-pointer hover:opacity-80 transition-opacity">
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">画像はありません (No images uploaded)</p>
                @endif
            </div>

            <p class="text-gray-700 break-words break-all whitespace-pre-wrap mb-6">
                {!! nl2br(e($thread->description ?? '説明がありません。(No description provided.)')) !!}
            </p>

            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <button class="flex-1 border border-black bg-white font-bold py-3 rounded-md hover:bg-gray-100 transition shadow-sm">
                    メッセージを送る
                </button>
                <button class="flex-1 border border-black bg-[#8faadc] font-bold py-3 rounded-md hover:bg-blue-300 transition shadow-sm">
                    取引リクエスト
                </button>
            </div>
        </div>

    </div>
</div>


<div id="lightbox" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 flex items-center justify-center p-4 transition-opacity duration-300">
    <button onclick="closeLightbox()" class="absolute top-4 right-6 text-white text-5xl font-bold hover:text-gray-300 z-50 focus:outline-none">
        &times;
    </button>
    
    <img id="lightboxImage" src="" class="max-w-full max-h-full object-contain rounded-md shadow-2xl">
</div>


<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');

    function openLightbox(imageSrc) {
        lightboxImage.src = imageSrc;
        lightbox.classList.remove('hidden');
        // Stop the background from scrolling while lightbox is open
        document.body.style.overflow = 'hidden'; 
    }

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightboxImage.src = ''; // Clear the image
        // Restore background scrolling
        document.body.style.overflow = 'auto'; 
    }

    // Advanced UX: Close the lightbox if the user clicks the black background
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Advanced UX: Close the lightbox if the user presses the 'Escape' key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });
</script>
@endsection