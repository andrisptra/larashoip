<x-admin-layout>
    <div class="space-y-6">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h2 class="text-2xl font-bold leading-7 text-gray-900">Transaction Details</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Order #{{ $transaction->id }}</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('admin.transactions.index') }}"
                    class="block rounded-md bg-white px-3 py-2 text-center text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back
                    to Transactions</a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Customer Information -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Customer Information</h3>
                <dl class="mt-4 space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $transaction->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $transaction->user->email }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Order Information -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Order Information</h3>
                <dl class="mt-4 space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Order Date</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $transaction->created_at->format('d M Y H:i') }}</dd>
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
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Order Items</h3>
                <div class="mt-4 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Product</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0">
                                                <div class="flex items-center">
                                                    @if ($detail->product->image)
                                                        <div class="h-10 w-10 flex-shrink-0">
                                                            <img class="h-10 w-10 rounded object-cover"
                                                                src="{{ Storage::url($detail->product->image) }}"
                                                                alt="{{ $detail->product->name }}">
                                                        </div>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900">
                                                            {{ $detail->product->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Rp
                                                {{ number_format($detail->price, 0, ',', '.') }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $detail->quantity }}</td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 text-right font-medium">
                                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="border-t border-gray-300">
                                        <td colspan="3"
                                            class="py-4 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-0 text-right">
                                            Total</td>
                                        <td class="py-4 px-3 text-sm font-bold text-gray-900 text-right">Rp
                                            {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
