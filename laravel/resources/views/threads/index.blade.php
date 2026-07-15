@extends('layouts.app')

@section('title', 'ホーム - NitKitシェア')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    
    


    <form action="{{ route('threads.index') }}" method="GET" class="mb-8">
        
        <div class="flex justify-between items-end mb-2">
            <h2 class="text-lg font-bold">検索</h2>
            <a href="{{ route('threads.index') }}" class="text-sm text-blue-600 hover:underline">条件をクリア (Clear)</a>
        </div>
        
        <div class="flex space-x-2 mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="アイテムを検索" 
                   class="flex-grow border border-gray-400 px-4 py-2 rounded-md focus:outline-none focus:border-[#1e2a5e]">
            <button type="submit" class="bg-[#1e2a5e] text-white px-6 py-2 rounded-md font-bold hover:opacity-90 transition">検索</button>
        </div>
        
        <div class="flex items-center space-x-3 relative">
            
            <div class="relative group">
                <div class="border border-gray-400 px-4 py-2 rounded-md bg-white w-48 text-left flex justify-between items-center text-gray-600 cursor-pointer hover:bg-gray-50 transition">
                    カテゴリ <span class="text-xs">▽</span>
                </div>
                
                <div class="absolute left-0 top-11 w-72 bg-white border border-gray-400 rounded-md shadow-lg z-50 p-4 hidden group-hover:block">
                    <div class="mb-4">
                        <p class="text-xs text-gray-600 mb-2">種類：</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['教科書' => 'bg-[#e2e8f0]', '参考書' => 'bg-white', 'スキル' => 'bg-[#e2e8f0]'] as $val => $bg)
                            <label class="cursor-pointer">
                                <input type="radio" name="category" value="{{ $val }}" class="peer sr-only" {{ request('category') == $val ? 'checked' : '' }}>
                                <span class="{{ $bg }} border border-black rounded-full px-3 py-1 text-xs font-bold peer-checked:ring-2 peer-checked:ring-offset-1 peer-checked:ring-[#1e2a5e] transition">{{ $val }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-xs text-gray-600 mb-2">学年：</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['1年', '2年', '3年', '4年', '5年'] as $grade)
                            <label class="cursor-pointer">
                                <input type="radio" name="grade_year" value="{{ $grade }}" class="peer sr-only" {{ request('grade_year') == $grade ? 'checked' : '' }}>
                                <span class="bg-white border border-black rounded-full w-10 h-8 flex items-center justify-center text-xs font-bold peer-checked:bg-gray-300 peer-checked:ring-2 peer-checked:ring-black transition">{{ $grade }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-xs text-gray-600 mb-2">コース：</p>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $courses = [
                                    '機械' => 'bg-[#8faadc] text-black',
                                    '知能' => 'bg-white text-black',
                                    '電気' => 'bg-[#a9d18e] text-black',
                                    '情報' => 'bg-[#ffff00] text-black',
                                    '化学' => 'bg-[#ff0000] text-white'
                                ];
                            @endphp
                            @foreach($courses as $name => $classes)
                            <label class="cursor-pointer">
                                <input type="radio" name="department" value="{{ $name }}" class="peer sr-only" {{ request('department') == $name ? 'checked' : '' }}>
                                <span class="{{ $classes }} border border-black rounded-full px-3 py-1 text-xs font-bold peer-checked:ring-2 peer-checked:ring-offset-1 peer-checked:ring-[#1e2a5e] transition">{{ $name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-2">
                        <p class="text-xs text-gray-600 mb-2">種別：</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['一般', '専門', '選択'] as $type)
                            <label class="cursor-pointer">
                                <input type="radio" name="course_type" value="{{ $type }}" class="peer sr-only" {{ request('course_type') == $type ? 'checked' : '' }}>
                                <span class="bg-white border border-black rounded-full px-3 py-1 text-xs font-bold peer-checked:bg-gray-300 peer-checked:ring-2 peer-checked:ring-black transition">{{ $type }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-4 text-right border-t pt-3">
                        <button type="submit" class="bg-[#1e2a5e] text-white px-4 py-1 rounded text-sm font-bold hover:opacity-90 transition">適用</button>
                    </div>
                </div>
            </div>

            <div class="relative group">
                <div class="border border-gray-400 px-4 py-2 rounded-md bg-white w-48 text-left flex justify-between items-center text-gray-600 cursor-pointer hover:bg-gray-50 transition">
                    ステータス <span class="text-xs">▽</span>
                </div>
                
                <div class="absolute left-0 top-11 w-72 bg-white border border-gray-400 rounded-md shadow-lg z-50 p-4 hidden group-hover:block max-h-[75vh] overflow-y-auto">
                    
                    <div class="mb-3 border-b pb-3">
                        <label class="flex items-center space-x-2 text-xs font-bold cursor-pointer">
                            <input type="checkbox" name="active_only" value="1" class="w-4 h-4 border-gray-400 rounded text-[#1e2a5e] focus:ring-[#1e2a5e] cursor-pointer" {{ request('active_only') ? 'checked' : '' }}>
                            <span>募集中・提供中のみ表示</span>
                        </label>
                    </div>

                    <p class="text-xs text-gray-600 mb-1">投稿時期：</p>
                    <div class="flex items-center space-x-2 mb-4 border-b pb-3">
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border border-gray-400 rounded bg-white text-xs h-8 px-2 focus:outline-none focus:border-[#1e2a5e]">
                        <span class="text-gray-500">~</span>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border border-gray-400 rounded bg-white text-xs h-8 px-2 focus:outline-none focus:border-[#1e2a5e]">
                    </div>

                    <p class="text-xs text-gray-600 mb-2">状態：</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(['未使用に近い', '傷・汚れ有', '書き込み有', '欠品有'] as $condition)
                        <label class="flex items-center space-x-2 text-xs font-bold cursor-pointer w-[45%]">
                            <input type="checkbox" name="conditions[]" value="{{ $condition }}" class="w-4 h-4 border-gray-400 rounded text-[#1e2a5e] focus:ring-[#1e2a5e] cursor-pointer" {{ is_array(request('conditions')) && in_array($condition, request('conditions')) ? 'checked' : '' }}>
                            <span class="truncate">{{ $condition }}</span>
                        </label>
                        @endforeach
                    </div>

                    <p class="text-xs text-gray-600 mb-2 border-t pt-3">依頼者のスキル：</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(['初学者', '一部自律', '習得済み', '熟練者'] as $skill)
                        <label class="flex items-center space-x-2 text-xs font-bold cursor-pointer w-[45%]">
                            <input type="checkbox" name="conditions[]" value="{{ $skill }}" class="w-4 h-4 border-gray-400 rounded text-[#1e2a5e] focus:ring-[#1e2a5e] cursor-pointer" {{ is_array(request('conditions')) && in_array($skill, request('conditions')) ? 'checked' : '' }}>
                            <span class="truncate">{{ $skill }}</span>
                        </label>
                        @endforeach
                    </div>

                    <p class="text-xs text-gray-600 mb-2 border-t pt-3">求められているスキル：</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['指導者', '開発協力'] as $req_skill)
                        <label class="flex items-center space-x-2 text-xs font-bold cursor-pointer w-[45%]">
                            <input type="checkbox" name="conditions[]" value="{{ $req_skill }}" class="w-4 h-4 border-gray-400 rounded text-[#1e2a5e] focus:ring-[#1e2a5e] cursor-pointer" {{ is_array(request('conditions')) && in_array($req_skill, request('conditions')) ? 'checked' : '' }}>
                            <span class="truncate">{{ $req_skill }}</span>
                        </label>
                        @endforeach
                    </div>

                    <div class="mt-4 text-right border-t pt-3">
                        <button type="submit" class="bg-[#1e2a5e] text-white px-4 py-1 rounded text-sm font-bold hover:opacity-90 transition">適用</button>
                    </div>
                </div>
            </div>
            
            <label class="flex items-center space-x-2 ml-4 cursor-pointer" title="選択した条件のON/OFFを切り替えます">
                <span class="font-bold">フィルター</span>
                <div class="relative">
                    <input type="checkbox" name="use_filters" value="1" class="sr-only peer" 
                           onchange="this.form.submit()" 
                           {{ request()->has('use_filters') ? 'checked' : '' }}>
                    <div class="w-14 h-7 bg-gray-300 peer-checked:bg-[#7ab756] rounded-full border border-black transition-colors duration-300 shadow-inner"></div>
                    <div class="w-6 h-6 bg-white rounded-full border border-black absolute left-[2px] top-[2px] peer-checked:translate-x-7 transition-transform duration-300 shadow"></div>
                </div>
            </label>
            
        </div>
    </form>


    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @foreach($threads as $thread)
        
        <a href="{{ route('threads.show', $thread->id) }}" class="bg-white border border-[#1e2a5e] rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col cursor-pointer">
            
            <div class="w-full h-48 overflow-hidden rounded-t-lg">
                @if($thread->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $thread->images->first()->image_path) }}" 
                        alt="{{ $thread->name }}" 
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                        No Image
                    </div>
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
                            $deptColor = match($thread->department) {
                                '情報' => 'bg-[#ffff00] text-black',
                                '機械' => 'bg-[#8faadc] text-black',
                                '電気' => 'bg-[#a9d18e] text-black',
                                '化学' => 'bg-[#ff0000] text-white',
                                default => 'bg-white text-black', 
                            };
                        @endphp
                        <span class="{{ $deptColor }} border border-black rounded-full px-3 py-1">
                            {{ $thread->department }}
                        </span>
                    @endif

                    <div class="flex flex-wrap gap-1 mt-2">
                        @if(!empty($thread->conditions))
                            {{-- collect() に変換して take(2) で最初の2つだけを取得 --}}
                            @foreach(collect($thread->conditions)->take(2) as $condition)
                                <span class="bg-white border border-gray-300 rounded-md px-2 py-0.5 text-[10px] text-gray-500 truncate max-w-[80px]">
                                    {{ $condition }}
                                </span>
                            @endforeach
                            
                            {{-- 3つ以上ある場合は「...」を表示 --}}
                            @if(count($thread->conditions) > 2)
                                <span class="text-[10px] text-gray-400 self-center">...</span>
                            @endif
                        @endif
                    </div>




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
    
    <div class="mt-8">
        {{ $threads->links() }}
    </div>

</div>
@endsection