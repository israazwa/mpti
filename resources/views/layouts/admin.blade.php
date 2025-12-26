<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <title>Admin</title>
</head>
<body class="bg-gray-800">
    @livewire('admin.component.navaside')  

    <!-- MAIN CONTENT -->
    <main class="p-4 lg:p-6 bg-gray-800 lg:ml-64">
        {{ $slot }}
    </main>

    <!-- Global Spinner Overlay -->
    <div wire:loading.flex
         class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
        <div class="flex flex-col items-center gap-2">
            <svg class="animate-spin h-10 w-10 text-indigo-500"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span class="text-indigo-300 font-semibold">Loading...</span>
        </div>
    </div>

    @livewireScripts
</body>
</html>