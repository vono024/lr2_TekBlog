@extends('layouts.app')

@section('title', $category->name . ' - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-4 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-blue-400">Головна</a> /
            <a href="{{ route('categories.index') }}" class="hover:text-blue-400">Категорії</a> /
            <span>{{ $category->name }}</span>
        </div>

        <div class="bg-slate-800 rounded-lg shadow-xl p-8 mb-8 border border-slate-700">
            <h1 class="text-4xl font-bold text-gray-100 mb-3">📂 {{ $category->name }}</h1>

            @if($category->description)
                <p class="text-gray-400 text-lg">{{ $category->description }}</p>
            @endif

            <p class="text-gray-500 mt-4">
                Всього постів: <span class="font-semibold text-gray-300">{{ $posts->total() }}</span>
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
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

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">👤 {{ $post->author->name }}</span>
                            </div>
                            <div class="flex space-x-2">
                                @foreach($post->tags->take(2) as $tag)
                                    <span class="text-xs bg-slate-700 text-gray-300 px-2 py-1 rounded">
                                    #{{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-400 hover:text-blue-300 text-sm transition">
                                Читати далі →
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 bg-slate-800 rounded-lg shadow border border-slate-700">
                    <p class="text-gray-400 text-lg">В цій категорії поки немає постів 😢</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="text-blue-400 hover:text-blue-300 mt-2 inline-block">
                            Створити перший пост
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
