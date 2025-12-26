<div x-data="{ sidebarOpen: false }" class="">
    <!-- BACKDROP MOBILE -->
    <div 
        class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
    ></div>

    <!-- SIDEBAR -->
    <aside 
        class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-gray-200 z-40 transform
               lg:translate-x-0 transition-transform duration-300"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-gray-700">
            <span class="text-xl font-bold">SiPanda</span>
        </div>

        <!-- Menu -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li>
                    <div class="items-center text-center text-indigo-300 font-mono px-6 py-2">
                        <span id="clock" class=""></span>
                    </div>
                </li>
                <li>
                    <a wire:navigate href="/homeAd" class="flex items-center px-6 py-3 hover:bg-gray-800">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Produk Dropdown -->
                <li x-data="{ openProduk: false }" class="list-none">
                    <button 
                        class="w-full flex items-center justify-between px-6 py-3 hover:bg-gray-800"
                        @click="openProduk = !openProduk"
                        :aria-expanded="openProduk"
                    >
                        <span class="flex items-center gap-2">
                            <i class="fas fa-box-open w-6"></i> Produk
                        </span>

                        <!-- Penanda dropdown -->
                        <svg class="w-4 h-4 transform transition-transform duration-300"
                            :class="{ 'rotate-180': openProduk }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Produk dengan animasi -->
                    <ul 
                        x-show="openProduk"
                        x-collapse
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="pl-12 space-y-1 bg-gray-800"
                    >
                        <li><a wire:navigate href="/allpro" class="block py-2 text-gray-400 hover:text-white">List Produk</a></li>
                        <li><a wire:navigate href="/inproduct" class="block py-2 text-gray-400 hover:text-white">Tambah Produk</a></li>
                        <li><a wire:navigate href="/kategoriad" class="block py-2 text-gray-400 hover:text-white">Kategori Produk</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- HEADER -->
    <header class="h-16 bg-gray-900 flex items-center px-4 lg:px-6 justify-between lg:ml-64">
        <div class="flex items-center gap-3">
            <!-- Hamburger -->
            <button 
                class="lg:hidden flex items-center justify-center text-white w-10 h-10 rounded-md bg-gray-900 hover:bg-gray-300"
                @click="sidebarOpen = true"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <h1 class="font-semibold text-md text-white flex items-center justify-between">
                <span id="greeting" class=" font-semibold"></span>
                <span class=" mx-1"><?= auth()->user()->name; ?></span>
                
            </h1>

            <script>
                function updateClockAndGreeting() {
                    const now = new Date();
                    const hours   = now.getHours();
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    const timeString = `${String(hours).padStart(2, '0')}:${minutes}:${seconds}`;

                    // Tentukan greeting berdasarkan jam
                    let greeting = '';
                    if (hours >= 5 && hours < 11) {
                        greeting = 'Selamat Pagi';
                    } else if (hours >= 11 && hours < 15) {
                        greeting = 'Selamat Siang';
                    } else if (hours >= 15 && hours < 18) {
                        greeting = 'Selamat Sore';
                    } else {
                        greeting = 'Selamat Malam';
                    }

                    document.getElementById('clock').textContent = timeString;
                    document.getElementById('greeting').textContent = greeting;
                }

                setInterval(updateClockAndGreeting, 1000);
                updateClockAndGreeting();
            </script>
        </div>
    </header>
</div>