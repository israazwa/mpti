<section class="bg-gray-900 text-white p-4 md:p-6 shadow-lg space-y-4 mt-10">
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-gray-700 pb-3 mt-10">
        <h2 class="text-lg md:text-xl font-bold">Contact Us</h2>
        <span class="text-xs md:text-sm text-orange-400">Realtime Chat</span>
    </div>

    <!-- Chat Area -->
    <div class="h-72 md:h-80 overflow-y-auto space-y-4 p-3 bg-gray-800 rounded"
     wire:poll.100ms="refreshMessages"
     x-data
     x-init="$watch('$wire.messages', () => { $el.scrollTop = $el.scrollHeight })"
     x-on:message-sent.window="$el.scrollTop = $el.scrollHeight">

       @foreach($messages as $msg)
        <!-- Pesan user -->
        <div class="flex justify-end">
            <div class="bg-orange-600 text-white px-3 py-2 rounded-lg max-w-[75%] text-sm shadow">
                {{ $msg['pesan'] }}
                <div class="text-xs text-gray-200 mt-1 text-right">
                    {{ $msg['kategori'] }} - {{ auth()->user()->name }} • {{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}
                </div>
            </div>
        </div>

        <!-- Balasan Admin -->
        @if(!empty($msg['replies']))
            @foreach($msg['replies'] as $reply)
                <div class="flex justify-start mt-2">
                    <div class="bg-gray-700 text-white px-3 py-2 rounded-lg max-w-[75%] text-sm shadow">
                        {{ $reply['body'] }}
                        <div class="text-xs text-gray-400 mt-1">
                            Admin • {{ \Carbon\Carbon::parse($reply['created_at'])->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
    </div>

    <!-- Input Area -->
        <form wire:submit.prevent="submit" class="flex gap-3">
            <input type="text" wire:model="pesan"
                placeholder="Tulis pesan..."
                class="flex-1 px-3 py-2 rounded bg-gray-700 border border-gray-600 text-white">
            <button type="submit"
                    class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                Kirim ➤
            </button>
        </form>

    <!-- Notifikasi realtime -->
    <div wire:loading wire:target="submit" class="text-orange-400 text-xs md:text-sm mt-2">
        Mengirim pesan...
    </div>
    <div x-data="{ show: false }" x-on:message-sent.window="show = true; setTimeout(() => show = false, 3000)">
        <p x-show="show" class="text-green-400 text-xs md:text-sm mt-2">Pesan berhasil dikirim!</p>
    </div>
</section>