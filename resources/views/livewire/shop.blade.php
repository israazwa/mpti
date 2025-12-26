{{-- <div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div> --}}

<div class="mt-14 py-12 bg-gray-900 min-h-screen">
  <div class="container mx-auto px-4">

    <!-- Filter Kategori -->
    <div class="flex items-center justify-between mb-8">
      <div class="flex items-center space-x-4">
        <select 
          wire:model="category" 
          wire:change="$refresh"
          class="px-8 md:px-48 py-2 border rounded bg-gray-800 dark:text-gray-200">
          <option value="">Semua</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
          @endforeach
        </select>

        <div class="text-white">Pilih kategori produk</div>

        <!-- Spinner muncul saat Livewire update -->
        <div wire:loading wire:target="category" class="ml-2">
          <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
          </svg>
        </div>
      </div>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="bg-gray-900 text-green-400 px-4 py-2 rounded shadow">
        {{ session('success') }}
      </div>
    @endif

    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @forelse($products as $product)
        <!-- Card Produk -->
        <div class="group bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col relative">
          <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/produk.png') }}"
            alt="{{ $product->name }}"
            class="w-full h-48 object-cover rounded-md mb-4">

          <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
            {{ $product->name }}
          </h3>

          <strong class="text-indigo-600 dark:text-indigo-400 mb-3">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </strong>

          <button 
            wire:click="addToCart({{ $product->id }})"
            class="mt-auto px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">
            Add to Cart
        </button>
        </div>
      @empty
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center text-center py-12 space-y-6">
          <div class="bg-gray-800 rounded-full p-6 shadow-lg">
            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h12.9M7 13h10m-6 8a2 2 0 11-4 0 2 2 0 014 0zm8 0a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
          </div>
          <p class="text-gray-300 text-lg font-medium">
            Barang sedang kosong
          </p>
          <a href="{{ route('dashboard') }}"
             class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
            <x-application-logo class="h-6 w-6 mr-2 fill-current text-white" />
            <span>Kembali ke Dashboard</span>
          </a>
        </div>
      @endforelse
    </div>
    <div class="mt-6 m-4 relative">
        <!-- Pagination -->
        {{ $products->links() }}

        <!-- Overlay Loading saat pindah halaman -->
        <div wire:loading wire:target="page" wire:change="$refresh"
            class="absolute inset-0 flex items-center justify-center bg-gray-900/40 rounded">
            <svg class="animate-spin h-8 w-8 text-orange-500"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </div>
    </div>
  </div>
</div>