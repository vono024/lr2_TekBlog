@extends('layouts.app')

@section('title', 'Створити пост - Tech Blog')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">✍️ Створити новий пост</h1>

        <form action="{{ route('posts.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-2">Заголовок *</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Введіть заголовок поста"
                    required
                >
            </div>

            <div>
                <label for="excerpt" class="block text-gray-700 font-semibold mb-2">Короткий опис</label>
                <textarea
                    name="excerpt"
                    id="excerpt"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Короткий опис поста (опціонально)"
                >{{ old('excerpt') }}</textarea>
            </div>

            <div>
                <label for="body" class="block text-gray-700 font-semibold mb-2">Текст поста *</label>
                <textarea
                    name="body"
                    id="body"
                    rows="10"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Основний текст вашого поста"
                    required
                >{{ old('body') }}</textarea>
            </div>

            <div>
                <label for="category_id" class="block text-gray-700 font-semibold mb-2">Категорія</label>
                <select
                    name="category_id"
                    id="category_id"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">-- Оберіть категорію --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tags" class="block text-gray-700 font-semibold mb-2">Теги (можна обрати кілька)</label>
                <select
                    name="tags[]"
                    id="tags"
                    multiple
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    size="6"
                >
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Утримуйте Ctrl (Cmd на Mac) для вибору кількох тегів</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                    💾 Зберегти пост
                </button>
                <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold">
                    ❌ Скасувати
                </a>
            </div>
        </form>
    </div>
@endsection
