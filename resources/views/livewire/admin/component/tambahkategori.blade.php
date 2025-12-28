<section class="p-6 bg-gray-900 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-white mb-4">Daftar Kategori</h2>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Wrapper agar tabel bisa scroll di mobile -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-gray-300">
            <thead>
                <tr class="bg-gray-800">
                    <th class="px-4 py-2">Nama Kategori</th>
                    <th class="px-4 py-2">Jumlah Produk</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border-b border-gray-700" x-data="{ openEdit: false, openDelete: false }">
                        <td class="px-4 py-2">{{ $category->name }}</td>
                        <td class="px-4 py-2">{{ $category->products_count }}</td>
                        <td class="px-4 py-2 flex flex-col sm:flex-row gap-2">
                            <!-- Tombol Edit -->
                            <button @click="openEdit = true"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded w-full sm:w-auto">
                                Edit
                            </button>

                            <!-- Modal Edit -->
                            <div x-show="openEdit"
                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                 x-transition aria-hidden="true" role="dialog">
                                <div class="bg-gray-900 rounded-lg shadow-lg w-full max-w-md p-6 mx-4 sm:mx-0">
                                    <h2 class="text-xl font-bold text-white mb-4">Edit Kategori</h2>

                                    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="name{{ $category->id }}" class="block text-sm font-medium text-gray-300">Nama Kategori</label>
                                            <input type="text" name="name" id="name{{ $category->id }}"
                                                   value="{{ $category->name }}"
                                                   class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>


                                        <div class="flex flex-col sm:flex-row justify-end gap-2">
                                            <button type="button" @click="openEdit = false"
                                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Tombol Hapus -->
                            <button @click="openDelete = true"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded w-full sm:w-auto">
                                Hapus
                            </button>

                            <!-- Modal Konfirmasi Hapus -->
                            <div x-show="openDelete"
                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                 x-transition aria-hidden="true" role="dialog">
                                <div class="bg-gray-900 rounded-lg shadow-lg w-full max-w-md p-6 mx-4 sm:mx-0">
                                    <h2 class="text-xl font-bold text-white mb-4">Konfirmasi Hapus</h2>
                                    <p class="text-gray-300 mb-4">Apakah Anda yakin ingin menghapus kategori <strong>{{ $category->name }}</strong>?</p>
                                    <div class="flex flex-col sm:flex-row justify-end gap-2">
                                        <button type="button" @click="openDelete = false"
                                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                                            Batal
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="w-full sm:w-auto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                                                Ya, Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Form Tambah Kategori -->
    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4 mt-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Tambah Kategori</label>
            <input type="text" name="name" id="name"
                   class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="Masukkan nama kategori">
            @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition">
            Simpan
        </button>
    </form>
</section>