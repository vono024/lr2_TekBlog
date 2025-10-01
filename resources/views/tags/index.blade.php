@extends('layouts.app')

@section('title', 'Теги - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">🏷️ Всі теги</h1>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex flex-wrap gap-3">
                @forelse($tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}"
                       class="inline-flex items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-5 py-3 rounded-full hover:from-blue-600 hover:to-blue-700 transition transform hover:scale-105 shadow-md">
                        <span class="font-semibold">#{{ $tag->name }}</span>
                        <span class="ml-2 bg-white bg-opacity-30 rounded-full px-2 py-1 text-xs">
                        {{ $tag->posts_count }}
                    </span>
                    </a>
                @empty
                    <p class="text-gray-500 text-center w-full py-8">Тегів поки немає 😢</p>
                @endforelse
            </div>
        </div>

        <div class="mt-8 bg-gray-50 rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">☁️ Хмара тегів</h2>
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
                       class="{{ $size }} text-gray-700 hover:text-blue-600 font-semibold transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
