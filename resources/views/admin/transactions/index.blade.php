<x-admin-layout>
    <div class="space-y-6">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h2 class="text-2xl font-bold leading-7 text-gray-900">Transactions</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">View all customer transactions and order details.</p>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            Order ID</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Customer
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                #{{ $transaction->id }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="font-medium text-gray-900">{{ $transaction->user->name }}</div>
                                <div class="text-gray-500">{{ $transaction->user->email }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 font-medium">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <x-status-badge :status="$transaction->status" />
                            </td>
                            <td
                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('admin.transactions.show', $transaction) }}"
                                    class="text-green-600 hover:text-green-900">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-8 text-center text-sm text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-2">No transactions found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($transactions->hasPages())
                <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
