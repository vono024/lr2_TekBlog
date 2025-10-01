@extends('layouts.app')

@section('title', '#' . $tag->name . ' - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-4 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Головна</a> /
            <a href="{{ route('tags.index') }}" class="hover:text-blue-600">Теги</a> /
            <span>#{{ $tag->name }}</span>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-8 mb-8">
            <h1 class="text-4xl font-bold mb-3">🏷️ #{{ $tag->name }}</h1>
            <p class="text-blue-100 text-lg">
                Знайдено постів: <span class="font-semibold">{{ $posts->total() }}</span>
            </p>
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
                            <span class="text-xs text-gray-500">
                            💬 {{ $post->comments->count() }}
                        </span>
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
                    <p class="text-gray-500 text-lg">З цим тегом поки немає постів 😢</p>
                    <a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                        Створити перший пост
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>

        <div class="mt-12 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">🔗 Схожі теги</h3>
            <div class="flex flex-wrap gap-2">
                @foreach(\App\Models\Tag::where('id', '!=', $tag->id)->inRandomOrder()->limit(10)->get() as $relatedTag)
                    <a href="{{ route('tags.show', $relatedTag) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-full text-sm transition">
                        #{{ $relatedTag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
