@extends('layouts.app')

@section('title', $product->name . ' - Магазин')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-4 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-blue-400">Головна</a> /
            <a href="{{ route('shop.index') }}" class="hover:text-blue-400">Магазин</a> /
            <span>{{ $product->name }}</span>
        </div>

        <div class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <div class="bg-gradient-to-br from-slate-700 to-slate-900 rounded-lg flex items-center justify-center h-96">
                    <span class="text-9xl">{{ $product->emoji }}</span>
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-4">
                    <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $product->category === 'subscription' ? 'bg-purple-900 text-purple-300' : ($product->category === 'device' ? 'bg-blue-900 text-blue-300' : 'bg-green-900 text-green-300') }}">
                        {{ ucfirst($product->category) }}
                    </span>
                        @if($product->is_popular)
                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-yellow-900 text-yellow-300">
                            🔥 Популярне
                        </span>
                        @endif
                    </div>

                    <h1 class="text-4xl font-bold text-gray-100 mb-4">{{ $product->name }}</h1>

                    <div class="mb-6">
                        <span class="text-4xl font-bold text-blue-400">${{ number_format($product->price, 2) }}</span>
                        @if($product->period)
                            <span class="text-gray-400 text-xl">/{{ $product->period }}</span>
                        @endif
                    </div>

                    <p class="text-gray-300 mb-6 leading-relaxed">{{ $product->description }}</p>

                    @if($product->features)
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-100 mb-3">✨ Особливості:</h3>
                            <ul class="space-y-2">
                                @foreach(json_decode($product->features) as $feature)
                                    <li class="flex items-start">
                                        <span class="text-green-400 mr-2">✓</span>
                                        <span class="text-gray-300">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex gap-4">
                        <button onclick="buyProduct('{{ $product->name }}')" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 font-semibold transition">
                            🛒 Купити зараз
                        </button>
                        @auth
                            <button onclick="toggleWishlist({{ $product->id }}, this)" id="wishlist-btn" class="px-6 bg-slate-700 text-gray-300 py-3 rounded-lg hover:bg-slate-600 transition">
                                💝 В обране
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="px-6 bg-slate-700 text-gray-300 py-3 rounded-lg hover:bg-slate-600 transition flex items-center">
                                💝 В обране
                            </a>
                        @endauth
                    </div>

                    <div class="mt-6 p-4 bg-slate-900 rounded-lg border border-slate-700">
                        <p class="text-sm text-gray-400">
                            <span class="text-green-400">✓</span> Миттєва доставка
                            <span class="mx-2">•</span>
                            <span class="text-green-400">✓</span> 30 днів гарантії
                            <span class="mx-2">•</span>
                            <span class="text-green-400">✓</span> Підтримка 24/7
                        </p>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-700 p-8">
                <h2 class="text-2xl font-bold text-gray-100 mb-4">📝 Детальний опис</h2>
                <div class="prose prose-invert max-w-none">
                    <p class="text-gray-300 leading-relaxed">
                        {!! nl2br(e($product->full_description ?? $product->description)) !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('shop.index') }}" class="text-blue-400 hover:text-blue-300 transition">
                ← Повернутися до магазину
            </a>
        </div>
    </div>

    <script>
        function buyProduct(productName) {
            alert('✅ Дякуємо за покупку!\n\n🎉 Ви придбали: ' + productName + '\n\n📧 Деталі надіслано на вашу email адресу.\n💳 Це імітація покупки для демонстрації.');
        }

        async function toggleWishlist(productId, button) {
            try {
                const response = await fetch(`/wishlist/toggle/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    if (data.action === 'added') {
                        button.textContent = '❤️ В обраному';
                        alert('💝 Додано в обране!');
                    } else {
                        button.textContent = '💝 В обране';
                        alert('Видалено з обраного');
                    }
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
@endsection
