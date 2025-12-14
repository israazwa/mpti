<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <title>Dashboard</title>
</head>
<body class="bg-gray-100">

    <!-- BACKDROP MOBILE -->
    <div 
        class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
    ></div>

    <div class="flex min-h-screen">

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
                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-800">
                            <i class="fas fa-home w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Dropdown -->
                    <ul class="space-y-1">
                        <!-- Base -->
                        <li x-data="{ openBase: false }" class="list-none">
                            <button 
                                class="w-full flex items-center justify-between px-6 py-3 hover:bg-gray-800"
                                @click="openBase = !openBase"
                                :aria-expanded="openBase"
                            >
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-layer-group w-6"></i> 
                                    Pengguna
                                </span>

                                <!-- indikator (logo atau chevron) -->
                                <div class="flex flex-col items-center -space-y-1">
                                    <a href="#">
                                        <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                                    </a>
                                </div>
                            </button>

                            <!-- Dropdown Base -->
                            <ul 
                                x-show="openBase" 
                                x-collapse 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="pl-12 space-y-1 bg-gray-800"
                            >
                                <li><a href="#" class="block py-2 text-gray-400 hover:text-white">Pembeli</a></li>
                                <li><a href="#" class="block py-2 text-gray-400 hover:text-white">Pembayaran</a></li>
                                <li><a href="#" class="block py-2 text-gray-400 hover:text-white">Laporan</a></li>
                            </ul>
                        </li>

                        <!-- Produk -->
                        <li x-data="{ openProduk: false }" class="list-none">
                            <button 
                                class="w-full flex items-center justify-between px-6 py-3 hover:bg-gray-800"
                                @click="openProduk = !openProduk"
                                :aria-expanded="openProduk"
                            >
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-box-open w-6"></i> 
                                    Produk
                                </span>

                                <!-- indikator (logo atau chevron) -->
                                <div class="flex flex-col items-center -space-y-1">
                                    <a href="#">
                                        <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                                    </a>
                                </div>
                            </button>

                            <!-- Dropdown Produk -->
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
                                <li><a href="#" class="block py-2 text-gray-400 hover:text-white">List Produk</a></li>
                                <li><a href="#" class="block py-2 text-gray-400 hover:text-white">Tambah Produk</a></li>
                                <li><a href="#" class="block py-2 text-gray-400 hover:text-white">Kategori Produk</a></li>
                            </ul>
                        </li>
                    </ul>
                        <div class=" bg-gray-900 px-3 rounded-xl items-center">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                <div class="font-medium text-base text-gray-300 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            </x-responsive-nav-link>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- MAIN AREA -->
        <div class="flex-1 lg:ml-64">

            <!-- HEADER / TOPBAR -->
            <header class="h-16 bg-white border-b flex items-center px-4 lg:px-6 justify-between">

                <!-- LEFT SIDE -->
                <div class="flex items-center gap-3">

                    <!-- HAMBURGER (MOBILE ONLY) -->
                    <button 
                        class="lg:hidden flex items-center justify-center w-10 h-10 rounded-md hover:bg-gray-100"
                        @click="sidebarOpen = true"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             stroke="currentColor" 
                             class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <h1 class="font-semibold text-xl">Dashboard</h1>
                </div>

                <!-- RIGHT SIDE -->
                <div class="flex items-center gap-4">
{{-- //cadangan --}}
                </div>

            </header>

            <!-- PAGE CONTENT -->
            <main class="p-4 lg:p-6">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>
</html>
