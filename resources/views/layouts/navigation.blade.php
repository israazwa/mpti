<nav 
    x-data="{ open: false, lastScroll: 0, visible: true }" 
    x-init="
        window.addEventListener('scroll', () => {
            let current = window.pageYOffset;
            if (current <= 0) {
                visible = true; 
            } else if (current > lastScroll) {
                visible = false; 
            } else {
                visible = true; 
            }
            lastScroll = current;
        });
    "
    :class="visible ? 'translate-y-0' : '-translate-y-full'"
    class="fixed top-0 left-0 w-full bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 transition-transform duration-300 z-50"
    id="navbar"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex">
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                        {{ __('Shop') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('about')">
                        {{ __('About Us') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('contact')">
                        {{ __('Contact Us') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- User & Cart Icons -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <a href="{{ route('profile.edit') }}">
                    <img src="{{ asset('user.png') }}" class="h-6 w-6" alt="User">
                </a>
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    @livewire('cartic')
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
            {{ __('Shop') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('about')">
            {{ __('About Us') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('contact')">
            {{ __('Contact Us') }}
        </x-responsive-nav-link>

        <!-- Responsive User & Cart -->
        <div class="flex sm:items-center sm:ms-6 space-x-4 space-y-4">
                <a href="{{ route('profile.edit') }}">
                    <img src="{{ asset('user.png') }}" class="h-6 w-6" alt="User">
                </a>
                <div class=" sm:items-center sm:ms-6 space-x-4 space-y-4">
                    @livewire('cartic')
                </div>
            </div>
    </div>
</nav>