<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tech Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#0f172a',
                            card: '#1e293b',
                            hover: '#334155',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-900 text-gray-100 min-h-screen">
@if(!in_array(Route::currentRouteName(), ['login', 'register']))
    <nav class="bg-slate-800 shadow-lg mb-8 border-b border-slate-700">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent hover:from-blue-400 hover:to-purple-500">
                        💻 Tech Blog
                    </a>
                </div>

                <button id="mobile-menu-button" class="lg:hidden text-gray-300 hover:text-blue-400 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div class="hidden lg:flex space-x-6 items-center">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-blue-400 transition">Головна</a>
                    <a href="{{ route('posts.index') }}" class="text-gray-300 hover:text-blue-400 transition">Пости</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-blue-400 transition">Категорії</a>
                    <a href="{{ route('tags.index') }}" class="text-gray-300 hover:text-blue-400 transition">Теги</a>
                    <a href="{{ route('shop.index') }}" class="text-gray-300 hover:text-blue-400 transition">🛒 Магазин</a>

                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition">
                                Вихід ({{ auth()->user()->name }})
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-blue-400 transition">Вхід</a>
                        <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                            Реєстрація
                        </a>
                    @endauth
                </div>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden mt-4 space-y-2">
                <a href="{{ route('home') }}" class="block text-gray-300 hover:text-blue-400 transition py-2">Головна</a>
                <a href="{{ route('posts.index') }}" class="block text-gray-300 hover:text-blue-400 transition py-2">Пости</a>
                <a href="{{ route('categories.index') }}" class="block text-gray-300 hover:text-blue-400 transition py-2">Категорії</a>
                <a href="{{ route('tags.index') }}" class="block text-gray-300 hover:text-blue-400 transition py-2">Теги</a>
                <a href="{{ route('shop.index') }}" class="block text-gray-300 hover:text-blue-400 transition py-2">🛒 Магазин</a>

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left text-gray-300 hover:text-red-400 transition py-2">
                            Вихід ({{ auth()->user()->name }})
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-300 hover:text-blue-400 transition py-2">Вхід</a>
                    <a href="{{ route('register') }}" class="block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-center">
                        Реєстрація
                    </a>
                @endauth
            </div>
        </div>
    </nav>
@else
    <nav class="bg-slate-800 shadow-lg mb-8 border-b border-slate-700">
        <div class="container mx-auto px-6 py-4">
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent hover:from-blue-400 hover:to-purple-500">
                    💻 Tech Blog
                </a>
            </div>
        </div>
    </nav>
@endif

<div class="container mx-auto px-4 sm:px-6">
    @include('partials.flash')
</div>

<main class="container mx-auto px-4 sm:px-6 py-8">
    @yield('content')
</main>

@if(!in_array(Route::currentRouteName(), ['login', 'register']))
    <footer class="bg-slate-800 text-gray-300 mt-12 py-6 border-t border-slate-700">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <p>&copy; 2025 Tech Blog. Всі права захищені.</p>
        </div>
    </footer>
@endif

<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
</script>
</body>
</html>
