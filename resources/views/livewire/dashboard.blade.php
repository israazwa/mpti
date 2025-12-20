<div class="mt-8 md:mt-3 ">
    @include('users.components.hero')
     @if(session('success'))
                <div class="bg-gray-900 text-green-400 px-4 py-2 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif
    <livewire:component.rekomendasi />
    @include('users.components.costom')
    @include('users.components.whyUs')
</div>