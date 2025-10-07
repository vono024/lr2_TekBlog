@extends('layouts.app')

@section('title', 'Теги - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent mb-8">🏷️ Всі теги</h1>

        <div class="bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700">
            <div class="flex flex-wrap gap-3">
                @forelse($tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}"
                       class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-3 rounded-full hover:from-blue-700 hover:to-purple-700 transition transform hover:scale-105 shadow-md">
                        <span class="font-semibold">#{{ $tag->name }}</span>
                        <span class="ml-2 bg-white bg-opacity-30 rounded-full px-2 py-1 text-xs">
                        {{ $tag->posts_count }}
                    </span>
                    </a>
                @empty
                    <p class="text-gray-400 text-center w-full py-8">Тегів поки немає 😢</p>
                @endforelse
            </div>
        </div>

        <div class="mt-8 bg-slate-900 rounded-lg p-8 border border-slate-700">
            <h2 class="text-2xl font-bold text-gray-100 mb-6">☁️ Хмара тегів</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    @php
                        $size = match(true) {
                            $tag->posts_count >= 10 => 'text-2xl',
                            $tag->posts_count >= 5 => 'text-xl',
                            default => 'text-base'
                        };
                    @endphp
                    <a href="{{ route('tags.show', $tag) }}"
                       class="{{ $size }} text-gray-400 hover:text-blue-400 font-semibold transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
