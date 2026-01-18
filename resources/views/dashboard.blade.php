<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2">Discover amazing products and manage your orders</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Orders</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ $recentTransactions->count() > 0 ? Auth::user()->transactions->count() : 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Cart Items</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ session('cart') ? count(session('cart')) : 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Available Products</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $products->total() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            @if ($recentTransactions->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                            <a href="{{ route('transactions.index') }}"
                                class="text-sm font-medium text-green-600 hover:text-green-500">View all →</a>
                        </div>
                        <div class="space-y-4">
                            @foreach ($recentTransactions as $transaction)
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Order #{{ $transaction->id }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $transaction->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-gray-900">Rp
                                                {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                            <x-status-badge :status="$transaction->status" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Browse Products by Category -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Browse by Category</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach ($categories as $category)
                            <a href="{{ route('home') }}?category={{ $category->id }}" class="group">
                                <div class="bg-gray-50 rounded-lg p-4 text-center hover:bg-green-50 transition">
                                    <div
                                        class="h-12 w-12 mx-auto mb-2 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200">
                                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">{{ $category->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $category->products_count }} items</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Featured Products -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Available Products</h3>
                        <a href="{{ route('home') }}"
                            class="text-sm font-medium text-green-600 hover:text-green-500">View all →</a>
                    </div>

                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach ($products as $product)
                                <div class="group">
                                    <div class="relative">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="aspect-square w-full rounded-lg bg-gray-100 object-cover group-hover:opacity-75 transition">
                                        @else
                                            <div
                                                class="aspect-square w-full rounded-lg bg-gray-100 flex items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                        <span
                                            class="absolute top-2 left-2 inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $product->name }}</h4>
                                        <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                            {{ Str::limit($product->description, 50) }}</p>
                                        <div class="mt-3 flex items-center justify-between">
                                            <p class="text-lg font-semibold text-green-600">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</p>
                                            @if ($product->stock > 0)
                                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit"
                                                        class="rounded-md bg-green-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-green-500">Add
                                                        to cart</button>
                                                </form>
                                            @else
                                                <span class="text-xs text-red-600 font-medium">Out of stock</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-8">No products available</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
