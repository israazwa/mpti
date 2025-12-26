<div class="p-6 bg-gray-800 min-h-screen text-gray-100">
    <h1 class="text-2xl font-bold mb-6"> Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Orders -->
        <div class="bg-gray-700 shadow rounded-lg p-5 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium text-gray-300">Total Orders</h2>
                <p class="text-2xl font-bold text-white">{{ $totalOrders }}</p>
            </div>
            <div class="text-blue-400 text-3xl">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-gray-700 shadow rounded-lg p-5 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium text-gray-300">Total Revenue</h2>
                <p class="text-2xl font-bold text-green-400">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="text-green-400 text-3xl">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-gray-700 shadow rounded-lg p-5 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium text-gray-300">Total Users</h2>
                <p class="text-2xl font-bold text-white">{{ $totalUsers }}</p>
            </div>
            <div class="text-purple-400 text-3xl">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-gray-700 shadow rounded-lg p-5 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium text-gray-300">Pending Orders</h2>
                <p class="text-2xl font-bold text-yellow-400">{{ $pendingOrders }}</p>
            </div>
            <div class="text-yellow-400 text-3xl">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
    </div>
    <!-- Responsive Chart Placeholder -->
    <div class="mt-10 bg-gray-700 shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-200">Order Statistics</h2>
        <div class="h-64 flex items-center justify-center text-gray-400">
            <span>📈 Chart Placeholder (Integrasi dengan Chart.js / ApexCharts)</span>
        </div>
    </div>
</div>