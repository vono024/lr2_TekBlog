@extends('layouts.app')

@section('title', 'Всі пости - Tech Blog')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">📰 Всі пости</h1>
        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            + Створити пост
        </a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($posts as $post)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-blue-600 font-semibold">
                        {{ $post->category->name ?? 'Без категорії' }}
                    </span>
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
                            @foreach($post->tags->take(3) as $tag)
                                <span class="text-xs bg-gray-200 px-2 py-1 rounded">
                                #{{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline text-sm">
                            Читати далі →
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">Постів поки немає 😢</p>
                <a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                    Створити перший пост
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endsection
