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

        <div class="flex-grow w-full">
            
            <div class="flex flex-col md:flex-row justify-between items-start mb-4">
                <h1 class="text-xl md:text-2xl font-bold mb-2 md:mb-0">{{ $thread->name }}（{{ $thread->type }}）</h1>
                <span class="text-gray-400 text-sm font-bold flex-shrink-0">{{ $thread->created_at->format('Y/m/d') }}</span>
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                <span class="border border-black rounded-full px-4 py-1 text-sm font-bold">{{ $thread->category }}</span>
                
                @if($thread->department)
                    <span class="border border-black rounded-full px-4 py-1 text-sm font-bold">{{ $thread->department }}</span>
                @endif

                @if($thread->conditions)
                    @foreach($thread->conditions as $condition)
                        <span class="border border-black rounded-full px-4 py-1 text-sm font-bold">{{ $condition }}</span>
                    @endforeach
                @endif
            </div>

            <p class="text-gray-700 text-sm mb-8 leading-relaxed">
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
@endsection