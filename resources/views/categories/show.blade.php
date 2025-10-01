@extends('layouts.app')

@section('title', $category->name . ' - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-4 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Головна</a> /
            <a href="{{ route('categories.index') }}" class="hover:text-blue-600">Категорії</a> /
            <span>{{ $category->name }}</span>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">📂 {{ $category->name }}</h1>

            @if($category->description)
                <p class="text-gray-600 text-lg">{{ $category->description }}</p>
            @endif

            <p class="text-gray-500 mt-4">
                Всього постів: <span class="font-semibold">{{ $posts->total() }}</span>
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-500">
                            {{ $post->published_at->format('d.m.Y') }}
                        </span>
                        </div>

                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($post->excerpt, 100) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">👤 {{ $post->author->name }}</span>
                            </div>
                            <div class="flex space-x-2">
                                @foreach($post->tags->take(2) as $tag)
                                    <span class="text-xs bg-gray-200 px-2 py-1 rounded">
                                    #{{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline text-sm">
                                Читати далі →
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow">
                    <p class="text-gray-500 text-lg">В цій категорії поки немає постів 😢</p>
                    <a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                        Створити перший пост
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
