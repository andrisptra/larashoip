<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <!-- Header -->
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold leading-7 text-gray-900">All Products</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Browse our complete collection</p>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                    <form method="GET" action="{{ route('products.index') }}"
                        class="space-y-4 md:space-y-0 md:flex md:gap-4">
                        <!-- Search -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Search products..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        </div>

                        <!-- Category Filter -->
                        <div class="flex-1">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->products_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort -->
                        <div class="flex-1">
                            <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                            <select name="sort" id="sort"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest
                                </option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price:
                                    Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Price: High to Low</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                                Apply
                            </button>
                            <a href="{{ route('products.index') }}"
                                class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Products Grid -->
                @if ($products->count() > 0)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($products as $product)
                            <div
                                class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-lg overflow-hidden hover:shadow-md transition">
                                <a href="{{ route('products.show', $product) }}">
                                    @if ($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                            class="h-48 w-full object-cover">
                                    @else
                                        <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                                            <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </a>
                                <div class="p-4">
                                    @if ($product->category)
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                    <div class="mt-3 flex items-center justify-between">
                                        <div>
                                            <p class="text-lg font-semibold text-green-600">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                            <p
                                                class="text-xs text-gray-500 {{ $product->stock < 10 ? 'text-red-600' : '' }}">
                                                Stock: {{ $product->stock }}
                                            </p>
                                        </div>
                                        @if ($product->stock > 0)
                                            <form action="{{ route('cart.add', $product) }}" method="POST"
                                                class="flex items-center gap-2">
                                                @csrf
                                                <input type="number" name="quantity" value="1" min="1"
                                                    max="{{ $product->stock }}"
                                                    class="w-16 rounded-md border-gray-300 text-sm py-1 px-2 focus:border-green-500 focus:ring-green-500">
                                                <button type="submit"
                                                    class="rounded-md bg-green-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-green-500">
                                                    Add
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700">
                                                Out of stock
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-4 text-sm font-semibold text-gray-900">No products found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or search terms</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                                View All Products
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
