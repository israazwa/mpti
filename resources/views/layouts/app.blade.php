<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>
<body class="font-sans antialiased bg-gray-700">

    <div id="loading-screen" 
     class="md:left-1/6 fixed inset-0 bg-white dark:bg-gray-700 flex flex-col items-center justify-center z-50 transition-opacity duration-500">
    <div class="animate-spin rounded-full h-12 w-12 sm:h-16 sm:w-16 border-t-4 border-blue-500"></div>
    <p class="mt-4 text-gray-700 dark:text-gray-200 text-sm sm:text-base font-semibold">
        Memuat, harap tunggu...
    </p>
</div>

    @include('layouts.navigation')

    <!-- Page Heading -->
    {{-- 
    @isset($header)
        <header class="bg-gray-200 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset 
    --}}

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    @include('users.components.footer')

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const shines = document.querySelectorAll(".shine-img");
            shines.forEach(el => {
                const delay = (Math.random() * 5).toFixed(2);
                el.style.setProperty("--shine-delay", `${delay}s`);
            });

            // AOS init
            AOS.init({
                duration: 3000,
                once: true
            });
        });

           
    let loadedCount = 0;
    const minLoaded = 6; 

    function hideLoader() {
        const loader = document.getElementById("loading-screen");
        loader.style.opacity = "0";
        setTimeout(() => loader.style.display = "none", 500);
    }
    const resources = document.querySelectorAll("img, script, link[rel='stylesheet']");
    resources.forEach(res => {
        res.addEventListener("load", () => {
            loadedCount++;
            if (loadedCount >= minLoaded) {
                hideLoader();
            }
        });
        res.addEventListener("error", () => {
            loadedCount++;
            if (loadedCount >= minLoaded) {
                hideLoader();
            }
        });
    });
    window.addEventListener("load", () => {
        hideLoader();
    });

    </script>
</body>
</html>