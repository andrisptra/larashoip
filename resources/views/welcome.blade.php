<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larashop - Modern E-Commerce Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
    <!-- Navigation -->
    <header class="bg-white border-b border-gray-200">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Top">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">Larashop</span>
                    </a>
                </div>

                <div class="hidden md:flex md:items-center md:space-x-6">
                    <a href="#products" class="text-sm font-medium text-gray-700 hover:text-gray-900">Products</a>
                    <a href="#features" class="text-sm font-medium text-gray-700 hover:text-gray-900">Features</a>
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm font-medium text-gray-700 hover:text-gray-900">Admin Panel</a>
                        @endif
                        <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-gray-900">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            @if (session('cart') && count(session('cart')) > 0)
                                <span
                                    class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-green-600 rounded-full">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Shop</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Sign
                            in</a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">Sign
                            up</a>
                    @endauth
                </div>

                <button type="button"
                    class="md:hidden rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="relative bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="py-24 sm:py-32">
                <div class="mx-auto max-w-2xl text-center">
                    <div class="mb-8 flex justify-center">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                            New products every week. <a href="#products" class="font-semibold text-green-600"><span
                                    class="absolute inset-0" aria-hidden="true"></span>Explore now <span
                                    aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                        Quality products for modern living
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Discover our curated selection of premium products. From home essentials to lifestyle
                        accessories, we bring you quality that lasts.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="#products"
                            class="rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Browse
                            products</a>
                        <a href="#features" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-green-600">Shop with confidence</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Everything you need for a
                    great shopping experience</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">We provide the best service to ensure your shopping is
                    seamless and enjoyable.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <svg class="h-5 w-5 flex-none text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                    clip-rule="evenodd" />
                            </svg>
                            Fast Delivery
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Get your orders delivered quickly with our express shipping options.
                                Track your package in real-time.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <svg class="h-5 w-5 flex-none text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                    clip-rule="evenodd" />
                            </svg>
                            Secure Payment
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Shop with confidence using our secure payment gateway. Your data is
                                protected with encryption.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <svg class="h-5 w-5 flex-none text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                    clip-rule="evenodd" />
                            </svg>
                            24/7 Support
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Our customer support team is always ready to help you with any
                                questions or concerns.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our Products</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">Explore our curated collection of premium products</p>
            </div>

            @if ($products->count() > 0)
                <div
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                    @foreach ($products as $product)
                        <article class="flex flex-col items-start">
                            <div class="relative w-full">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                                @else
                                    <div
                                        class="aspect-[16/9] w-full rounded-2xl bg-gray-100 flex items-center justify-center sm:aspect-[2/1] lg:aspect-[3/2]">
                                        <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                            </div>
                            <div class="w-full">
                                <div class="mt-4 flex items-center gap-x-2 text-xs">
                                    <span
                                        class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </div>
                                <div class="group relative">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 line-clamp-1">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="mt-2 text-sm leading-6 text-gray-600 line-clamp-2">
                                        {{ Str::limit($product->description, 60) }}</p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <p class="text-lg font-semibold text-green-600">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                    @if ($product->stock > 0)
                                        @auth
                                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit"
                                                    class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Add
                                                    to cart</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Login
                                                to buy</a>
                                        @endauth
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Out
                                            of Stock</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="mx-auto mt-16 max-w-2xl text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No products</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by adding your first product.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-green-600">
        <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Ready to start shopping?<br>Create
                    your account today.</h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-green-100">Join thousands of satisfied customers
                    and discover quality products at great prices.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('register') }}"
                        class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-green-600 shadow-sm hover:bg-green-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get
                        started</a>
                    <a href="#products" class="text-sm font-semibold leading-6 text-white">Browse products <span
                            aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <div class="flex items-center">
                        <svg class="h-7 w-7 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">Larashop</span>
                    </div>
                    <p class="text-sm leading-6 text-gray-600">Your trusted online shopping destination for quality
                        products.</p>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Shop</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">All
                                        Products</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">New
                                        Arrivals</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Best
                                        Sellers</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact</a></li>
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">FAQ</a></li>
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Shipping</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">About</a></li>
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a></li>
                                <li><a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-gray-500">&copy; 2026 Larashop. Built with Laravel & Tailwind CSS.</p>
            </div>
        </div>
    </footer>
</body>

</html>

</html>
