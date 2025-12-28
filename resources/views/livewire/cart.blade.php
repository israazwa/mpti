<section>
    <div class="mt-28 container mx-auto px-4 py-10 mb-10">
        <div class="mb-8 px-3 text-white text-5xl font-bold">Keranjang Belanja</div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mx-3">
            <!-- Cart Content -->
            <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-light mb-6 border-b pb-2">
                    Pastikan Anda telah memeriksanya dengan teliti!
                </h2>

                @forelse($cart as $item)
                    <div class="flex justify-between items-center py-4 border-b">
                        <div class="flex items-center gap-4">
                            @if($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-16 h-16 object-cover rounded">
                            @endif

                            <div>
                                <span class="block font-medium">{{ $item['name'] }}</span>
                                <div class="flex items-center gap-2 mt-2">
                                    <button wire:click="decreaseQuantity({{ $item['id'] }})"
                                            class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                    <span class="px-3">{{ $item['quantity'] }}</span>
                                    <button wire:click="increaseQuantity({{ $item['id'] }})"
                                            class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                                    <button wire:click="removeFromCart({{ $item['id'] }})"
                                            class="ml-3 text-red-500 hover:text-red-700">🗑</button>
                                </div>
                            </div>
                        </div>
                        <span class="font-semibold text-gray-700">
                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500">Keranjang kosong.</p>
                @endforelse
            </div>

            <!-- Ringkasan + Form -->
            <div class="bg-gray-50 shadow rounded-lg p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold mb-6 border-b pb-2">Ringkasan</h2>
                    <div class="flex justify-between items-center text-lg mb-6">
                        <span>Total:</span>
                        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                    </div>

                    <!-- Form Alamat Pengiriman -->
                    <form wire:submit.prevent="checkout" class="space-y-4">
                        <div>
                            <label class="block text-sm">Nama Penerima</label>
                            <input type="text" wire:model="nama_penerima"
                                   class="w-full px-3 py-2 rounded bg-white border border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm">Telepon</label>
                            <input type="text" wire:model="telepon"
                                   class="w-full px-3 py-2 rounded bg-white border border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm">Alamat Lengkap</label>
                            <textarea wire:model="alamat_lengkap"
                                      class="w-full px-3 py-2 rounded bg-white border border-gray-300"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm">Kota</label>
                                <input type="text" wire:model="kota"
                                       class="w-full px-3 py-2 rounded bg-white border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm">Kode Pos</label>
                                <input type="text" wire:model="kode_pos"
                                       class="w-full px-3 py-2 rounded bg-white border border-gray-300">
                            </div>
                        </div>

                        <!-- Tombol Checkout + Spinner -->
                        <div class="mt-6 relative">
                            @if(count($cart) > 0)
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition"
                                        wire:loading.attr="disabled">
                                    Bayar Sekarang
                                </button>

                                <!-- Spinner -->
                                <div wire:loading wire:target="checkout"
                                    class="absolute inset-0 flex items-center justify-center bg-orange-600 bg-opacity-75 rounded-lg">
                                    <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-full border border-red-800 px-6 py-3 bg-gray-300 text-red-700 rounded-lg text-center font-semibold">
                                    Whoops! Keranjang masih kosong
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Livewire.on('open-payment', data => {
                if (data.snapToken) {
                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            Livewire.emit('refreshCart');
                        },
                        onPending: function(result) {
                            console.log('Pending', result);
                        },
                        onError: function(result) {
                            console.log('Error', result);
                        },
                        onClose: function() {
                            console.log('Popup closed');
                        }
                    });
                } else {
                    alert('Snap Token gagal dibuat');
                }
            });
        });
    </script>
</section>