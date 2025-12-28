<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  {{-- Sidebar daftar pesan --}}
  <aside class="lg:col-span-1 bg-gray-800 text-white rounded-lg p-4">
    <div class="flex items-center gap-2 mb-4">
      <input type="text" wire:model.debounce.300ms="search"
             placeholder="Cari pesan..."
             class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600">
    </div>

    <ul class="space-y-2">
    @forelse($users as $u)
      <li>
        <button class="w-full text-left px-3 py-2 rounded
                      {{ $selectedUserId === $u->id ? 'bg-orange-600' : 'bg-gray-700 hover:bg-gray-600' }}"
                wire:click="selectUser({{ $u->id }})">
          <div class="flex justify-between items-center">
            <span class="font-semibold">{{ $u->name }}</span>
            @if($u->unread_count > 0)
              <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                {{ $u->unread_count }}
              </span>
            @endif
          </div>

         <div class="text-sm opacity-80 truncate">
          {{ optional($u->messages->last())->pesan ?? 'Belum ada pesan' }}
        </div>

        <div class="text-xs opacity-70">
          {{ optional($u->messages->last())->created_at?->format('d M Y, H:i') ?? '' }}
        </div>
        </button>
      </li>
    @empty
      <li class="text-gray-300">Belum ada user dengan pesan.</li>
    @endforelse
  </ul>
  </aside>

  {{-- Panel balasan --}}
  <section class="lg:col-span-2 bg-white rounded-lg p-4">
    @if($selected)
      <div class="mb-4">
        <div class="text-sm text-gray-500">Kategori: {{ $selected->kategori ?: 'Umum' }}</div>
        <div class="text-lg font-semibold text-gray-900">Pesan pengguna</div>
        <p class="text-gray-800">{{ $selected->pesan }}</p>
      </div>

      {{-- Riwayat balasan --}}
      <div class="space-y-3 max-h-72 overflow-y-auto border border-gray-200 rounded p-3">
        @forelse(optional($selected)->replies ?? [] as $r)
          <div class="flex justify-end">
            <div class="bg-orange-100 text-orange-900 px-3 py-2 rounded max-w-[80%]">
              <div class="text-sm">{{ $r->body }}</div>
              <div class="text-xs text-orange-700 mt-1">
                {{ $r->created_at->format('d M Y, H:i') }}
              </div>
            </div>
          </div>
        @empty
          <div class="text-gray-500 text-sm">Belum ada balasan.</div>
        @endforelse
      </div>

      {{-- Form balasan --}}
      <form wire:submit.prevent="sendReply" class="mt-4 flex gap-2">
        <input type="text" wire:model.defer="replyBody"
               placeholder="Tulis balasan..."
               class="flex-1 px-3 py-2 rounded border border-gray-300">
        <button type="submit"
                class="px-4 py-2 rounded bg-orange-600 text-white hover:bg-orange-700">
          Kirim
        </button>
      </form>

      @error('replyBody')
        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
      @enderror
    @else
      <div class="text-gray-600">Pilih pesan di sebelah kiri untuk membalas.</div>
    @endif
  </section>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    // optional: tampilkan toast saat balasan terkirim
  });
  window.addEventListener('reply-sent', () => {
    // contoh: scroll ke bawah riwayat
    const box = document.querySelector('.max-h-72.overflow-y-auto');
    if (box) box.scrollTop = box.scrollHeight;
  });
</script>

</div>
