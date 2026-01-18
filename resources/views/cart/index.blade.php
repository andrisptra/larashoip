<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900">Shopping Cart</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Review and manage items in your cart.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('cart') && count(session('cart')) > 0)
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <!-- Cart Items -->
                        <div class="lg:col-span-2 space-y-4">
                            @foreach (session('cart') as $id => $details)
                                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                                    <div class="flex items-center">
                                        @if ($details['image'])
                                            <img src="{{ Storage::url($details['image']) }}"
                                                alt="{{ $details['name'] }}" class="h-24 w-24 rounded object-cover">
                                        @else
                                            <div class="h-24 w-24 rounded bg-gray-200 flex items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="ml-6 flex-1">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $details['name'] }}</h3>
                                            <p class="mt-1 text-sm text-gray-500">Rp
                                                {{ number_format($details['price'], 0, ',', '.') }} each</p>
                                            @php
                                                $product = \App\Models\Product::find($id);
                                            @endphp
                                            @if($product)
                                                <p class="mt-1 text-xs {{ $product->stock < 10 ? 'text-red-600' : 'text-gray-500' }}">
                                                    Stock: {{ $product->stock }} available
                                                </p>
                                            @endif
                                            <div class="mt-4 flex items-center gap-4">
                                                <form action="{{ route('cart.update') }}" method="POST"
                                                    class="flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                                    <label for="quantity-{{ $id }}"
                                                        class="sr-only">Quantity</label>
                                                    <input type="number" id="quantity-{{ $id }}"
                                                        name="quantity" value="{{ $details['quantity'] }}"
                                                        min="1" max="{{ $product ? $product->stock : 999 }}"
                                                        class="block w-20 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                                                    <button type="submit"
                                                        class="ml-2 text-sm font-medium text-green-600 hover:text-green-500">Update</button>
                                                </form>
                                                <form action="{{ route('cart.remove') }}" method="POST"
                                                    onsubmit="return confirm('Remove this item from cart?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                                    <button type="submit"
                                                        class="text-sm font-medium text-red-600 hover:text-red-500">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="ml-4 text-right">
                                            <p class="text-lg font-semibold text-gray-900">Rp
                                                {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6 sticky top-6">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Order Summary</h3>
                                <dl class="mt-6 space-y-4">
                                    @php
                                        $subtotal = 0;
                                        foreach (session('cart') as $details) {
                                            $subtotal += $details['price'] * $details['quantity'];
                                        }
                                    @endphp
                                    <div class="flex items-center justify-between">
                                        <dt class="text-sm text-gray-600">Subtotal</dt>
                                        <dd class="text-sm font-medium text-gray-900">Rp
                                            {{ number_format($subtotal, 0, ',', '.') }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                        <dt class="text-base font-semibold text-gray-900">Total</dt>
                                        <dd class="text-base font-semibold text-gray-900">Rp
                                            {{ number_format($subtotal, 0, ',', '.') }}</dd>
                                    </div>
                                </dl>
                                <form action="{{ route('cart.checkout') }}" method="POST" class="mt-6"
                                    onsubmit="return confirm('Confirm your order?');">
                                    @csrf
                                    <button type="submit"
                                        class="w-full rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                        Proceed to Checkout
                                    </button>
                                </form>
                                <a href="{{ route('dashboard') }}"
                                    class="mt-4 block w-full text-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="mt-4 text-sm text-gray-500">Your cart is empty</p>
                        <a href="{{ route('dashboard') }}"
                            class="mt-6 inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
