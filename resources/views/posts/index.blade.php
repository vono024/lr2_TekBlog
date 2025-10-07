@extends('layouts.app')

@section('title', 'Всі пости - Tech Blog')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">📰 Всі пости</h1>
        @auth
            <div class="flex space-x-4">
                <a href="{{ route('user.posts', auth()->user()) }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    👤 Мої пости
                </a>
                <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    + Створити пост
                </a>
            </div>
        @endauth
    </div>

    @if($posts->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 @if($posts->count() % 3 === 1) justify-items-center @endif">
            @foreach($posts as $post)
                <article class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition transform hover:-translate-y-1 @if($loop->last && $posts->count() % 3 === 1) lg:col-start-2 @endif">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-blue-400 font-semibold px-3 py-1 bg-blue-900 rounded-full">
                            {{ $post->category->name ?? 'Без категорії' }}
                        </span>
                            <span class="text-xs text-gray-500">
                            {{ $post->published_at->format('d.m.Y') }}
                        </span>
                        </div>

                        <h2 class="text-xl font-bold text-gray-100 mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-400 transition">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-gray-400 text-sm mb-4">
                            {{ Str::limit($post->excerpt, 100) }}
                        </p>

                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('user.posts', $post->author) }}" class="text-sm text-gray-500 hover:text-blue-400 transition">
                                    👤 {{ $post->author->name }}
                                </a>
                            </div>
                            <div class="flex space-x-2">
                                @foreach($post->tags->take(3) as $tag)
                                    <span class="text-xs bg-slate-700 text-gray-300 px-2 py-1 rounded">
                                    #{{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-400 hover:text-blue-300 text-sm transition">
                                Читати далі →
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-slate-800 rounded-lg border border-slate-700">
            <p class="text-gray-400 text-lg">Постів поки немає 😢</p>
            @auth
                <a href="{{ route('posts.create') }}" class="text-blue-400 hover:text-blue-300 mt-2 inline-block">
                    Створити перший пост
                </a>
            @endauth
        </div>
    @endif

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endsection
