@extends('layouts.app')

@section('title', $post->title . ' - Tech Blog')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-4 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Головна</a> /
            <a href="{{ route('posts.index') }}" class="hover:text-blue-600">Пости</a> /
            <span>{{ $post->title }}</span>
        </div>

        <article class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-4">
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded">
                {{ $post->category->name ?? 'Без категорії' }}
            </span>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

            <div class="flex items-center text-gray-600 text-sm mb-6 space-x-4">
                <span>👤 {{ $post->author->name }}</span>
                <span>📅 {{ $post->published_at->format('d.m.Y H:i') }}</span>
                <span>💬 {{ $post->comments->count() }} коментарів</span>
            </div>

            @if($post->excerpt)
                <div class="bg-gray-50 border-l-4 border-blue-600 p-4 mb-6">
                    <p class="text-gray-700 italic">{{ $post->excerpt }}</p>
                </div>
            @endif

            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($post->body)) !!}
            </div>

            <div class="mt-8 pt-6 border-t">
                <span class="font-semibold text-gray-700">Теги:</span>
                @foreach($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}" class="inline-block bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-sm text-gray-700 mr-2 mt-2">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    ✏️ Редагувати
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Видалити пост?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        🗑️ Видалити
                    </button>
                </form>
            </div>
        </article>

        <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-6">💬 Коментарі ({{ $post->comments->count() }})</h3>

            <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-8">
                @csrf
                <textarea
                    name="content"
                    rows="4"
                    class="w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Залишіть свій коментар..."
                    required
                ></textarea>
                <button type="submit" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Надіслати коментар
                </button>
            </form>

            <div class="space-y-4">
                @forelse($post->comments as $comment)
                    <div class="border-l-4 border-gray-300 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-800">{{ $comment->content }}</p>
                                <p class="text-sm text-gray-500 mt-2">
                                    <span class="font-semibold">{{ $comment->user->name ?? $comment->author_name }}</span>
                                    • {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST" onsubmit="return confirm('Видалити коментар?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Видалити</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">Коментарів поки немає. Будьте першим! 😊</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
