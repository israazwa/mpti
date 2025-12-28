{{-- <div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div> --}}

<div class="bg-gray-300 py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Pesan sukses -->
    @if ($massage)
      <div class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg">
        {{ $massage }}
      </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-stretch">

      <!-- Kolom 1: Text Content -->
      <div class="lg:col-span-1 space-y-4 flex flex-col justify-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Produk Unggulan</h2>
        <p class="text-gray-600 text-justify">
          Temukan berbagai produk unggulan kami yang dirancang untuk memberikan kualitas terbaik 
          dan pengalaman pengguna yang memuaskan. Setiap produk dibuat dengan perhatian pada detail, 
          inovasi, dan kenyamanan, sehingga dapat mendukung kebutuhan Anda sehari-hari.
        </p>
        <a href="shop.html"
           class="shine-effect inline-block text-center py-3 font-semibold bg-orange-600 text-white rounded-md shadow hover:bg-orange-700 w-full">
          Buka Katalog
        </a>
      </div>

      <!-- Kolom 2: Produk -->
      @foreach ($products->take(3) as $product)
        <div wire:click="addToCart({{ $product->id }})"
             wire:change="$refresh"
             class="bg-gray-50 rounded-lg shadow hover:shadow-2xl
                    transition-transform duration-200 ease-in-out
                    p-4 text-center relative hover:scale-105 hover:cursor-pointer">

          <!-- Gambar Produk -->
          <div class="shine-img">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/produk.png') }}"
            alt="{{ $product->name }}"
            class="mx-auto object-contain">
          </div>

          <!-- Nama & Harga -->
          <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
          <strong class="text-orange-600">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </strong>

          <!-- Tombol Add to Cart -->
          <button class="absolute left-1/2 transform -translate-x-1/2 translate-y-1 block space-y-5">
            <img src="{{ asset('cross.png') }}" alt="Add" class="h-8 w-8">
          </button>
        </div>
      @endforeach

      <!-- Toast Notification -->
      <div id="toast" class="hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-gray-500/30 px-10 py-10 rounded-full shadow-lg flex items-center justify-center">
          <img src="{{ asset('cart.svg') }}" alt="Cart" class="h-20 w-auto">
        </div>
      </div>

      <!-- Script Toast -->
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          Livewire.on('cart-added', data => {
            let toastWrapper = document.getElementById('toast');
            toastWrapper.classList.remove('hidden');

            // Hilang otomatis setelah 3 detik
            setTimeout(() => {
              toastWrapper.classList.add('hidden');
            }, 3000);
          });
        });
      </script>

    </div>
  </div>
</div>