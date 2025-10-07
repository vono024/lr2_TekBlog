@extends('layouts.app')

@section('title', '#' . $tag->name . ' - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-4 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-blue-400">Головна</a> /
            <a href="{{ route('tags.index') }}" class="hover:text-blue-400">Теги</a> /
            <span>#{{ $tag->name }}</span>
        </div>

        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg shadow-xl p-8 mb-8">
            <h1 class="text-4xl font-bold mb-3">🏷️ #{{ $tag->name }}</h1>
            <p class="text-blue-100 text-lg">
                Знайдено постів: <span class="font-semibold">{{ $posts->total() }}</span>
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition">
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

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">👤 {{ $post->author->name }}</span>
                            </div>
                            <span class="text-xs text-gray-500">
                            💬 {{ $post->comments->count() }}
                        </span>
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
                    <p class="text-gray-400 text-lg">З цим тегом поки немає постів 😢</p>
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

        <div class="mt-12 bg-slate-800 rounded-lg shadow-xl p-6 border border-slate-700">
            <h3 class="text-xl font-bold text-gray-100 mb-4">🔗 Схожі теги</h3>
            <div class="flex flex-wrap gap-2">
                @foreach(\App\Models\Tag::where('id', '!=', $tag->id)->inRandomOrder()->limit(10)->get() as $relatedTag)
                    <a href="{{ route('tags.show', $relatedTag) }}"
                       class="bg-slate-700 hover:bg-slate-600 text-gray-300 px-3 py-1 rounded-full text-sm transition">
                        #{{ $relatedTag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
