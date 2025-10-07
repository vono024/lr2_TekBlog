@extends('layouts.app')

@section('title', 'Пости користувача ' . $user->name)

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-100 mb-2">
                        👤 Пости користувача {{ $user->name }}
                    </h1>
                    <p class="text-gray-400">Всього постів: <span class="font-semibold text-gray-300">{{ $posts->total() }}</span></p>
                </div>
                @auth
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            + Створити пост
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition transform hover:-translate-y-1">
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

                        <div class="flex space-x-2 mb-4">
                            @foreach($post->tags->take(3) as $tag)
                                <span class="text-xs bg-slate-700 text-gray-300 px-2 py-1 rounded">
                                #{{ $tag->name }}
                            </span>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-400 hover:text-blue-300 text-sm transition">
                                Читати далі →
                            </a>
                            @auth
                                @if(auth()->id() === $post->user_id)
                                    <div class="flex space-x-2">
                                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-400 hover:text-yellow-300 text-sm">
                                            ✏️
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Видалити пост?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 bg-slate-800 rounded-lg border border-slate-700">
                    <p class="text-gray-400 text-lg">У цього користувача поки немає постів 😢</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
