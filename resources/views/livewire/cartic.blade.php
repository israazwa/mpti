<div wire:poll.3s>
    <a href="{{ route('cart') }}" class="inline-block" style="position: relative;">
        <img src="{{ asset('cart.svg') }}" class="h-6 w-6" alt="Cart">
        @if($count > 0)
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">
                {{ $count }}
            </span>
        @endif
    </a>
</div>