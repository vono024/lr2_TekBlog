@extends('layouts.app')

@section('title', 'Редагувати пост - Tech Blog')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-100 mb-6">✏️ Редагувати пост</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" class="bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-gray-300 font-semibold mb-2">Заголовок *</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $post->title) }}"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required
                >
            </div>

            <div>
                <label for="excerpt" class="block text-gray-300 font-semibold mb-2">Короткий опис</label>
                <textarea
                    name="excerpt"
                    id="excerpt"
                    rows="3"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>

            <div>
                <label for="body" class="block text-gray-300 font-semibold mb-2">Текст поста *</label>
                <textarea
                    name="body"
                    id="body"
                    rows="10"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required
                >{{ old('body', $post->body) }}</textarea>
            </div>

            <div>
                <label for="category_id" class="block text-gray-300 font-semibold mb-2">Категорія</label>
                <select
                    name="category_id"
                    id="category_id"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">-- Оберіть категорію --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tags" class="block text-gray-300 font-semibold mb-2">Теги (можна обрати кілька)</label>
                <select
                    name="tags[]"
                    id="tags"
                    multiple
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    size="6"
                >
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold transition">
                    💾 Оновити пост
                </button>
                <a href="{{ route('posts.show', $post) }}" class="bg-slate-700 text-gray-300 px-6 py-3 rounded-lg hover:bg-slate-600 font-semibold transition">
                    ❌ Скасувати
                </a>
            </div>
        </form>
    </div>
@endsection
