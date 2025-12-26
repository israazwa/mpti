<div class="p-6 bg-gray-800 min-h-screen text-gray-100">
    <h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Kategori</label>
            <select name="category_id" class="mt-1 block w-full rounded bg-gray-700 text-gray-100 border-gray-600">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Nama Produk</label>
            <input type="text" name="name" class="mt-1 block w-full rounded bg-gray-700 text-gray-100 border-gray-600">
            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Deskripsi</label>
            <textarea name="description" rows="3" class="mt-1 block w-full rounded bg-gray-700 text-gray-100 border-gray-600"></textarea>
            @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Harga</label>
            <input type="number" name="price" class="mt-1 block w-full rounded bg-gray-700 text-gray-100 border-gray-600">
            @error('price') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Stock -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Stok</label>
            <input type="number" name="stock" class="mt-1 block w-full rounded bg-gray-700 text-gray-100 border-gray-600">
            @error('stock') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Image -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Gambar Produk</label>
            
            <div class="flex items-center space-x-4">
                <!-- Input File -->
                <input type="file" 
                    name="image" 
                    wire:model="image"
                    class="block w-full text-sm text-gray-100 
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-600 file:text-white
                            hover:file:bg-blue-700
                            cursor-pointer" />

                <!-- Preview -->
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" 
                        alt="Preview" 
                        class="h-20 w-20 object-cover rounded-md shadow">
                @endif
            </div>

            @error('image') 
                <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Active -->
        <div class=" items-center hidden">
            <input type="checkbox" name="is_active" value="1" class="h-4 w-4 text-orange-500 bg-gray-700 border-gray-600 rounded">
            <label class="ml-2 text-sm text-gray-300">Aktifkan Produk</label>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 rounded text-white font-semibold">
                Simpan Produk
            </button>
        </div>
    </form>
</div>