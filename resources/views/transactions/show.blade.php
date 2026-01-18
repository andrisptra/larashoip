<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900">Order Details</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Order #{{ $transaction->id }}</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('transactions.index') }}"
                            class="block rounded-md bg-white px-3 py-2 text-center text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back
                            to Orders</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Order Information -->
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Order Information</h3>
                        <dl class="mt-4 space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Order Date</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $transaction->created_at->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <x-status-badge :status="$transaction->status" />
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Payment Summary -->
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Payment Summary</h3>
                        <dl class="mt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm font-medium text-gray-500">Total Amount</dt>
                                <dd class="text-sm font-semibold text-gray-900">Rp
                                    {{ number_format($transaction->total_amount, 0, ',', '.') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900 mb-6">Order Items</h3>
                    <div class="space-y-4">
                        @foreach ($transaction->details as $detail)
                            <div class="flex items-center py-4 border-b border-gray-200 last:border-b-0">
                                @if ($detail->product->image)
                                    <img src="{{ Storage::url($detail->product->image) }}"
                                        alt="{{ $detail->product->name }}" class="h-20 w-20 rounded object-cover">
                                @else
                                    <div class="h-20 w-20 rounded bg-gray-200 flex items-center justify-center">
                                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="ml-4 flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $detail->product->name }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">{{ $detail->product->description }}</p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <p class="text-sm text-gray-500">Quantity: {{ $detail->quantity }}</p>
                                        <p class="text-sm font-medium text-gray-900">Rp
                                            {{ number_format($detail->base_price, 0, ',', '.') }} each</p>
                                    </div>
                                </div>
                                <div class="ml-4 text-right">
                                    <p class="text-sm font-medium text-gray-900">Rp
                                        {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center justify-between pt-4 border-t-2 border-gray-300">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-gray-900">Rp
                                {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
