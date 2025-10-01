@extends('layouts.app')

@section('title', 'Категорії - Tech Blog')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">📂 Всі категорії</h1>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                   class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-xl font-bold text-gray-800">{{ $category->name }}</h2>
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ $category->posts_count }} {{ Str::plural('пост', $category->posts_count) }}
                    </span>
                    </div>

                    @if($category->description)
                        <p class="text-gray-600 text-sm">
                            {{ Str::limit($category->description, 100) }}
                        </p>
                    @endif

                    <div class="mt-4 text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        Переглянути пости →
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">Категорій поки немає 😢</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
