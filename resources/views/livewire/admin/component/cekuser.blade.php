<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="p-6 bg-gray-900 text-white rounded-lg">
    <h2 class="text-xl font-bold mb-4">Cek Status Pembayaran User</h2>

     <div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-700">
        <thead>
            <tr class="bg-gray-800">
                <th class="border border-gray-700 px-4 py-2">User</th>
                <th class="border border-gray-700 px-4 py-2">Order ID</th>
                <th class="border border-gray-700 px-4 py-2">Gateway</th>
                <th class="border border-gray-700 px-4 py-2">Transaction ID</th>
                <th class="border border-gray-700 px-4 py-2">Amount</th>
                <th class="border border-gray-700 px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td class="border border-gray-700 px-4 py-2">
                        {{ $payment->order->user->name ?? 'Unknown User' }}
                    </td>
                    <td class="border border-gray-700 px-4 py-2">{{ $payment->order_id }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $payment->gateway }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $payment->transaction_id }}</td>
                    <td class="border border-gray-700 px-4 py-2">Rp {{ number_format($payment->amount,0,',','.') }}</td>
                    <td class="border border-gray-700 px-4 py-2">
                        @if($payment->status === 'pending')
                            <span class="px-2 py-1 bg-yellow-600 text-white rounded">Pending</span>
                        @elseif($payment->status === 'success')
                            <span class="px-2 py-1 bg-green-600 text-white rounded">Success</span>
                        @elseif($payment->status === 'failed')
                            <span class="px-2 py-1 bg-red-600 text-white rounded">Failed</span>
                        @else
                            <span class="px-2 py-1 bg-gray-600 text-white rounded">Unknown</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-400">
                        Tidak ada data pembayaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
</div>
