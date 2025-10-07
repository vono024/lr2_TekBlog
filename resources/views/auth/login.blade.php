@extends('layouts.app')

@section('title', 'Вхід - Tech Blog')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700">
            <h1 class="text-3xl font-bold text-center mb-8 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                🔐 Вхід
            </h1>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-gray-300 font-semibold mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="your@email.com"
                        required
                    >
                </div>

                <div>
                    <label for="password" class="block text-gray-300 font-semibold mb-2">Пароль</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <div class="flex items-center">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="w-4 h-4 text-blue-600 bg-slate-700 border-slate-600 rounded focus:ring-blue-500"
                    >
                    <label for="remember" class="ml-2 text-gray-300 text-sm">Запам'ятати мене</label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 font-semibold transition">
                    Увійти
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Немає акаунту?
                    <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">Зареєструватися</a>
                </p>
            </div>
        </div>
    </div>
@endsection
