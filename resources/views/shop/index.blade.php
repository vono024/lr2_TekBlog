@extends('layouts.app')

@section('title', 'Магазин - Tech Blog')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-4xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent mb-2">
                    🛒 Магазин технологій
                </h1>
                <p class="text-sm sm:text-base text-gray-400">Підписки, гаджети та девайси для розробників</p>
            </div>
            @auth
                <a href="{{ route('wishlist.index') }}" class="w-full sm:w-auto bg-purple-600 text-white px-4 sm:px-6 py-3 rounded-lg hover:bg-purple-700 transition font-semibold text-center">
                    💝 Список бажань
                </a>
            @endauth
        </div>

        @if($products->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 @if($products->count() % 3 === 1) lg:justify-items-center @endif">
                @foreach($products as $product)
                    <div class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition @if($loop->last && $products->count() % 3 === 1) lg:col-start-2 @endif">
                        <div class="h-40 sm:h-48 bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                            <span class="text-5xl sm:text-6xl">{{ $product->emoji }}</span>
                        </div>

                        <div class="p-4 sm:p-6">
                            <div class="flex items-center justify-between mb-2 flex-wrap gap-2">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $product->category === 'subscription' ? 'bg-purple-900 text-purple-300' : ($product->category === 'device' ? 'bg-blue-900 text-blue-300' : 'bg-green-900 text-green-300') }}">
                                {{ ucfirst($product->category) }}
                            </span>
                                @if($product->is_popular)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-yellow-900 text-yellow-300">
                                    🔥 Популярне
                                </span>
                                @endif
                            </div>

                            <h3 class="text-lg sm:text-xl font-bold text-gray-100 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 80) }}</p>

                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div>
                                    <span class="text-xl sm:text-2xl font-bold text-blue-400">${{ number_format($product->price, 2) }}</span>
                                    @if($product->period)
                                        <span class="text-gray-500 text-xs sm:text-sm">/{{ $product->period }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('shop.show', $product->id) }}" class="bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                    Детальніше
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-slate-800 rounded-lg border border-slate-700">
                <p class="text-gray-400 text-lg">Товарів поки немає 😢</p>
            </div>
        @endif

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
@endsection

