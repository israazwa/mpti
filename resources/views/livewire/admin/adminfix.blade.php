<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="bg-gray-900 text-white p-6 rounded-lg shadow space-y-4">
    <h2 class="text-xl font-bold">Manajemen User</h2>

    <input type="text" wire:model.debounce.300ms="search"
           placeholder="Cari user..."
           class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 text-white">

    <table class="w-full text-sm mt-4 border border-gray-700 rounded">
        <thead class="bg-gray-800 text-gray-300">
            <tr>
                <th class="px-3 py-2 text-left">Nama</th>
                <th class="px-3 py-2 text-left">Email</th>
                <th class="px-3 py-2 text-left">Role</th>
                <th class="px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr class="border-t border-gray-700">
                    <td class="px-3 py-2">{{ $u['name'] }}</td>
                    <td class="px-3 py-2">{{ $u['email'] }}</td>
                    <td class="px-3 py-2">
                        <select wire:model="selectedRole.{{ $u['id'] }}"
                                class="bg-gray-700 text-white rounded px-2 py-1">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="guest">Guest</option>
                        </select>
                    </td>
                    <td class="px-3 py-2 text-center">
                        <button wire:click="updateRole({{ $u['id'] }})"
                                class="bg-orange-600 hover:bg-orange-700 px-3 py-1 rounded text-white">
                            Simpan
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div x-data="{ show: false }" x-on:role-updated.window="show = true; setTimeout(() => show = false, 3000)">
        <p x-show="show" class="text-green-400 text-xs mt-2">Role berhasil diperbarui!</p>
    </div>
</div>

</div>
