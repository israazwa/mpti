<div class="p-6 bg-gray-900 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-white mb-4">Daftar Produk</h2>

    <!-- Search & Filter -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <input type="text"
           wire:model.live.debounce.200ms="search"
           placeholder="Cari produk..."
           class="flex-1 bg-gray-700 text-white rounded px-4 py-2">

        <select wire:model.live="category_id" class="bg-gray-700 text-white rounded  px-5 py-2">
            <option value=""> Semua Kategori </option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <!-- Spinner -->
        <div wire:loading class="flex items-center gap-2 text-indigo-400">
            <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span>Loading...</span>
        </div>
    </div>

    <!-- Wrapper agar tabel bisa scroll di mobile -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-gray-300">
            <thead>
                <tr class="bg-gray-800">
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Stok</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b border-gray-700" x-data="{ openEdit: false, openDelete: false }">
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($product->price,0,',','.') }}</td>
                        <td class="px-4 py-2">{{ $product->stock }}</td>
                        <td class="px-4 py-2">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                        <td class="px-4 py-2 flex flex-col md:flex-row gap-2">
                            <!-- Tombol Edit -->
                            <button @click="openEdit = true"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <button @click="openDelete = true"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Hapus
                            </button>

                            <!-- Modal Edit -->
                            <div x-show="openEdit"
                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                 x-transition>
                                <div class="bg-gray-900 rounded-lg shadow-lg w-full max-w-lg mx-4 p-6">
                                    <h2 class="text-xl font-bold text-white mb-4">Edit Produk</h2>
                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $product->name }}" class="block w-full bg-gray-700 text-white rounded">
                                        <textarea name="description" class="block w-full bg-gray-700 text-white rounded">{{ $product->description }}</textarea>
                                        <input type="number" name="price" value="{{ $product->price }}" class="block w-full bg-gray-700 text-white rounded">
                                        <input type="number" name="stock" value="{{ $product->stock }}" class="block w-full bg-gray-700 text-white rounded">
                                        <select name="category_id" class="block w-full bg-gray-700 text-white rounded">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" @if($product->category_id==$cat->id) selected @endif>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="file" name="image" class="block w-full text-gray-300">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" name="is_active" id="active{{ $product->id }}"
                                                   @if($product->is_active) checked @endif
                                                   class="rounded bg-gray-700 border-gray-600 text-indigo-600 focus:ring-indigo-500">
                                            <label for="active{{ $product->id }}" class="text-gray-300">Aktif</label>
                                        </div>
                                        <div class="flex justify-end gap-2">
                                            <button type="button" @click="openEdit=false"
                                                    class="bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
                                            <button type="submit"
                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div x-show="openDelete"
                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                 x-transition>
                                <div class="bg-gray-900 rounded-lg shadow-lg w-full max-w-md mx-4 p-6">
                                    <h2 class="text-xl font-bold text-white mb-4">Konfirmasi Hapus</h2>
                                    <p class="text-gray-300 mb-4">
                                        Apakah Anda yakin ingin menghapus produk <strong>{{ $product->name }}</strong>?
                                    </p>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="openDelete = false"
                                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Batal</button>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Ya, Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 py-4">Produk tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>