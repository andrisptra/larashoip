<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900">My Orders</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">View your order history and track deliveries.</p>
                    </div>
                </div>

                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    @forelse($transactions as $transaction)
                        <div class="border-b border-gray-200 last:border-b-0">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Order #{{ $transaction->id }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $transaction->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <x-status-badge :status="$transaction->status" />
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                            class="text-sm font-medium text-green-600 hover:text-green-500">View
                                            Details</a>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($transaction->details->take(2) as $detail)
                                        <div class="flex items-center">
                                            @if ($detail->product->image)
                                                <img src="{{ Storage::url($detail->product->image) }}"
                                                    alt="{{ $detail->product->name }}"
                                                    class="h-16 w-16 rounded object-cover">
                                            @else
                                                <div
                                                    class="h-16 w-16 rounded bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-8 w-8 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="ml-4 flex-1">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $detail->product->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $detail->quantity }} x Rp
                                                    {{ number_format($detail->base_price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($transaction->details->count() > 2)
                                        <p class="text-sm text-gray-500">+ {{ $transaction->details->count() - 2 }} more
                                            items</p>
                                    @endif
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-500">Total</span>
                                    <span class="text-lg font-bold text-gray-900">Rp
                                        {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">You haven't placed any orders yet</p>
                            <a href="{{ route('products.index') }}"
                                class="mt-4 inline-block text-sm font-medium text-green-600 hover:text-green-500">Start
                                Shopping</a>
                        </div>
                    @endforelse

                    @if ($transactions->hasPages())
                        <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
