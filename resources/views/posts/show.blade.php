@extends('layouts.app')

@section('title', $post->title . ' - Tech Blog')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-4 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-blue-400">Головна</a> /
            <a href="{{ route('posts.index') }}" class="hover:text-blue-400">Пости</a> /
            <span>{{ $post->title }}</span>
        </div>

        <article class="bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700">
            <div class="mb-4">
            <span class="bg-blue-900 text-blue-300 text-xs font-semibold px-3 py-1 rounded-full">
                {{ $post->category->name ?? 'Без категорії' }}
            </span>
            </div>

            <h1 class="text-4xl font-bold text-gray-100 mb-4">{{ $post->title }}</h1>

            <div class="flex items-center text-gray-400 text-sm mb-6 space-x-4">
                <span>👤 {{ $post->author->name }}</span>
                <span>📅 {{ $post->published_at->format('d.m.Y H:i') }}</span>
                <span>💬 {{ $post->comments->count() }} коментарів</span>
            </div>

            @if($post->excerpt)
                <div class="bg-slate-900 border-l-4 border-blue-500 p-4 mb-6">
                    <p class="text-gray-300 italic">{{ $post->excerpt }}</p>
                </div>
            @endif

            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed mb-6">
                {!! nl2br(e($post->body)) !!}
            </div>

            <div class="mt-8 pt-6 border-t border-slate-700">
                <span class="font-semibold text-gray-300">Теги:</span>
                @foreach($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}" class="inline-block bg-slate-700 hover:bg-slate-600 rounded px-3 py-1 text-sm text-gray-300 mr-2 mt-2 transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>

            @auth
                @if(auth()->id() === $post->user_id)
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                            ✏️ Редагувати
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Видалити пост?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                🗑️ Видалити
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </article>

        <div class="mt-8 bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700">
            <h3 class="text-2xl font-bold mb-6 text-gray-100">💬 Коментарі ({{ $post->comments->count() }})</h3>

            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-8">
                    @csrf
                    <textarea
                        name="content"
                        rows="4"
                        class="w-full bg-slate-700 border border-slate-600 rounded-lg p-4 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Залишіть свій коментар..."
                        required
                    ></textarea>
                    <button type="submit" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Надіслати коментар
                    </button>
                </form>
            @else
                <div class="mb-8 p-4 bg-slate-900 rounded-lg border border-slate-700 text-center">
                    <p class="text-gray-400">
                        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">Увійдіть</a> або
                        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">зареєструйтесь</a>, щоб залишити коментар
                    </p>
                </div>
            @endauth

            <div class="space-y-4">
                @forelse($post->comments as $comment)
                    <div class="border-l-4 border-slate-700 pl-4 py-2 bg-slate-900 rounded">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-300">{{ $comment->content }}</p>
                                <p class="text-sm text-gray-500 mt-2">
                                    <span class="font-semibold text-gray-400">{{ $comment->user->name ?? $comment->author_name }}</span>
                                    • {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @auth
                                @if(auth()->id() === $comment->user_id)
                                    <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST" onsubmit="return confirm('Видалити коментар?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm transition">Видалити</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">Коментарів поки немає. Будьте першим! 😊</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
