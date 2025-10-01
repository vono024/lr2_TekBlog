<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tech Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<nav class="bg-white shadow-lg mb-8">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800">
                    💻 Tech Blog
                </a>
            </div>
            <div class="flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Головна</a>
                <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-600">Пости</a>
                <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600">Категорії</a>
                <a href="{{ route('tags.index') }}" class="text-gray-700 hover:text-blue-600">Теги</a>
                <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Створити пост
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container mx-auto px-6">
    @include('partials.flash')
</div>

<main class="container mx-auto px-6 py-8">
    @yield('content')
</main>

<footer class="bg-gray-800 text-white mt-12 py-6">
    <div class="container mx-auto px-6 text-center">
        <p>&copy; 2025 Tech Blog. Всі права захищені.</p>
    </div>
</footer>
</body>
</html>
