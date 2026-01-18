<x-admin-layout>
    <div class="space-y-8">
        <!-- Welcome Header -->
        <div>
            <h2 class="text-3xl font-bold leading-7 text-gray-900">Dashboard</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Welcome back, {{ Auth::user()->name }}! Here's what's
                happening with your store today.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Revenue -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-600">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                        <p class="text-2xl font-semibold text-gray-900">Rp
                            {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-600">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Orders</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalOrders) }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-600">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Products</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalProducts) }}</p>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alert -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-lg {{ $lowStockProducts > 0 ? 'bg-red-600' : 'bg-gray-400' }}">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Low Stock Alert</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($lowStockProducts) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <h3 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Add Product -->
                <a href="{{ route('admin.products.create') }}"
                    class="group relative bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 group-hover:bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 group-hover:text-green-600">Add New
                            Product</span>
                    </div>
                </a>

                <!-- Add Category -->
                <a href="{{ route('admin.categories.create') }}"
                    class="group relative bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 group-hover:bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 group-hover:text-blue-600">Add New
                            Category</span>
                    </div>
                </a>

                <!-- View Products -->
                <a href="{{ route('admin.products.index') }}"
                    class="group relative bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 group-hover:bg-purple-100">
                            <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 group-hover:text-purple-600">Manage
                            Products</span>
                    </div>
                </a>

                <!-- View Statistics -->
                <a href="{{ route('admin.statistics') }}"
                    class="group relative bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 group-hover:text-orange-600">View
                            Statistics</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Transactions -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Recent Transactions</h3>
                </div>
                <div class="px-6 py-4">
                    @if ($recentTransactions->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentTransactions as $transaction)
                                <div
                                    class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-900">Rp
                                            {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                        <x-status-badge :status="$transaction->status" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.transactions.index') }}"
                                class="text-sm font-medium text-green-600 hover:text-green-500">View all transactions
                                →</a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 py-4">No transactions yet</p>
                    @endif
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Top Selling Products</h3>
                </div>
                <div class="px-6 py-4">
                    @if ($topProducts->count() > 0)
                        <div class="space-y-4">
                            @foreach ($topProducts as $product)
                                <div
                                    class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                    <div class="flex items-center flex-1">
                                        @if ($product->image)
                                            <img src="{{ Storage::url($product->image) }}"
                                                alt="{{ $product->name }}" class="h-10 w-10 rounded object-cover">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-500">Stock: {{ $product->stock }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ number_format($product->total_sold ?? 0) }} sold</p>
                                        <p class="text-xs text-gray-500">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.products.index') }}"
                                class="text-sm font-medium text-green-600 hover:text-green-500">View all products →</a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 py-4">No products yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
