@extends('layouts.app')

@section('title', 'Список бажань - Tech Blog')

@section('content')
    <div class="max-w-7xl mx-auto min-h-screen">
        <div class="mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent mb-2">
                💝 Мій список бажань
            </h1>
            <p class="text-gray-400">Обрані товари: {{ $products->total() }}</p>
        </div>

        @if($products->count() > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 @if($products->count() % 3 === 1) justify-items-center @endif">
                @foreach($products as $product)
                    <div class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition transform hover:-translate-y-1 @if($loop->last && $products->count() % 3 === 1) lg:col-start-2 @endif">
                        <div class="h-48 bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center relative">
                            <span class="text-6xl">{{ $product->emoji }}</span>
                            <button onclick="toggleWishlist({{ $product->id }}, this)" class="absolute top-4 right-4 text-red-500 hover:text-red-400 text-2xl">
                                ❤️
                            </button>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $product->category === 'subscription' ? 'bg-purple-900 text-purple-300' : ($product->category === 'device' ? 'bg-blue-900 text-blue-300' : 'bg-green-900 text-green-300') }}">
                                {{ ucfirst($product->category) }}
                            </span>
                                @if($product->is_popular)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-yellow-900 text-yellow-300">
                                    🔥 Популярне
                                </span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-gray-100 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 80) }}</p>

                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-blue-400">${{ number_format($product->price, 2) }}</span>
                                    @if($product->period)
                                        <span class="text-gray-500 text-sm">/{{ $product->period }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('shop.show', $product->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Детальніше
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-slate-800 rounded-lg border border-slate-700">
                <p class="text-gray-400 text-lg mb-4">Ваш список бажань порожній 😢</p>
                <a href="{{ route('shop.index') }}" class="text-blue-400 hover:text-blue-300">
                    Перейти до магазину
                </a>
            </div>
        @endif
    </div>

    <script>
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
                    if (data.action === 'removed') {
                        button.closest('.grid > div').remove();
                        location.reload();
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
@endsection
