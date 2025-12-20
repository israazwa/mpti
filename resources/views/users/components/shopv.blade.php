<div class="block">
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    <div class=" py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="mb-8 flex justify-between items-center">
                <select class="px-8 md:px-32 py-2 border rounded bg-gray-50 dark:bg-gray-800 dark:text-gray-200">
                    <option>Semua</option>
                    <option>Kursi</option>
                    <option>Meja</option>
                    <option>Sofa</option>
                </select>
                <div class="text-center text-white mr-5">
                    Lorem ipsum dolor sit.
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <!-- Product Card -->
                <a href="#" class="group block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4">
                    <img src="produk.png" alt="Nordic Chair" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Nordic Chair</h3>
                    <strong class="text-indigo-600 dark:text-indigo-400">$50.00</strong>
                    <span class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition">
                        <img src="images/cross.svg" class="h-6 w-6" alt="Add to cart">
                    </span>
                </a>
        <button 
            wire:click="$dispatch('addToCart', 'Nordic Chair', 30000,1,'loerma')"
            class="mt-2 px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">
            Add to Cart
        </button>

                <!-- Product Card -->
                <a href="#" class="group block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4">
                    <img src="produk.png" alt="Nordic Chair" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Nordic Chair</h3>
                    <strong class="text-indigo-600 dark:text-indigo-400">$50.00</strong>
                    <span class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition">
                        <img src="images/cross.svg" class="h-6 w-6" alt="Add to cart">
                    </span>
                </a>

                <!-- Product Card -->
                <a href="#" class="group block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4">
                    <img src="produk.png" alt="Kruzo Aero Chair" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Kruzo Aero Chair</h3>
                    <strong class="text-indigo-600 dark:text-indigo-400">$78.00</strong>
                    <span class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition">
                        <img src="images/cross.svg" class="h-6 w-6" alt="Add to cart">
                    </span>
                </a>

                <!-- Product Card -->
                <a href="#" class="group block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4">
                    <img src="produk.png" alt="Ergonomic Chair" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Ergonomic Chair</h3>
                    <strong class="text-indigo-600 dark:text-indigo-400">$43.00</strong>
                    <span class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition">
                        <img src="images/cross.svg" class="h-6 w-6" alt="Add to cart">
                    </span>
                </a>

            </div>
        </div>
    </div>
    <section>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat, iure! Vitae officiis quasi nihil? Aut, voluptatibus accusantium praesentium nulla aperiam tempore ipsa consequatur sequi facere dolor quo doloribus totam eligendi.
    </section>
</div>
