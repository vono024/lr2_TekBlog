@extends('layouts.app')

@section('title', 'Реєстрація - Tech Blog')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-slate-800 rounded-lg shadow-xl p-8 border border-slate-700">
            <h1 class="text-3xl font-bold text-center mb-8 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                📝 Реєстрація
            </h1>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-gray-300 font-semibold mb-2">Ім'я</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ваше ім'я"
                        required
                    >
                </div>

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

                <div>
                    <label for="password_confirmation" class="block text-gray-300 font-semibold mb-2">Підтвердження пароля</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-3 rounded-lg hover:from-purple-700 hover:to-blue-700 font-semibold transition">
                    Зареєструватися
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Вже є акаунт?
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">Увійти</a>
                </p>
            </div>
        </div>
    </div>
@endsection
