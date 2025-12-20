{{-- <div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
</div> --}}
<div class="bg-gray-100 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row items-center justify-between">
            
            <!-- Text Content -->
            <div class="lg:w-5/12 mb-8 lg:mb-0">
                <div class="space-y-6">
                <h1 class="text-4xl font-bold text-gray-900 leading-tight noselect">
                    SiPanda
                   <span class="shine-text text-orange-400 noselect">
                    Toko Online Serba Ada
                    </span>

                    <style>
                    .shine-text {
                    position: relative;
                    display: inline-block;
                    font-weight: bold;
                    color: #f97316; 
                    overflow: hidden;
                    }

                    .shine-text::after {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(
                        135deg,
                        transparent 40%,
                        rgba(255,255,255,0.6) 50%,
                        transparent 60%
                    );
                    animation: shineOverlay 5s linear infinite;
                    }

                    @keyframes shineOverlay {
                    0% {
                        left: -100%;
                    }
                    100% {
                        left: 100%;
                    }
                    }
                    </style>
                </h1>
                <p class="text-gray-600 noselect">
                    Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. 
                    Aliquam vulputate velit imperdiet dolor tempor tristique.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="shine-effect px-8 py-3  bg-orange-600 text-white rounded-md shadow hover:bg-orange-700">
                    Shop Now
                    </a>
                    <a href="#" class="px-8 py-3 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-200">
                    Explore
                    </a>
                </div>
            </div>
            </div>
            <!-- Image -->
            <div x-data="{
                    images: ['hero.png','produk.png','dump.png','dump2.png'],
                    active: 0,
                    loading: true,
                    loaded: [],
                    init() {
                        this.loaded = new Array(this.images.length).fill(false);
                        setInterval(() => {
                            this.active = (this.active + 1) % this.images.length;
                            // spinner hanya muncul jika gambar aktif belum pernah dimuat
                            this.loading = !this.loaded[this.active];
                        }, 4000);
                    }
                }" 
                class="relative w-full h-64 sm:h-80 lg:h-96 overflow-hidden noselect">

                <!-- Spinner Loading -->
                <div 
                    x-show="loading"
                    x-transition.opacity.duration.500ms
                    class="absolute inset-0 flex items-center justify-center bg-white/40">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-orange-500 border-solid"></div>
                </div>

                <!-- Images -->
                <template x-for="(img, index) in images" :key="index">
                    <img 
                        :src="img" 
                        alt="Slide"
                        @load="loaded[index] = true; loading = false"
                        class="absolute inset-0 max-w-full max-h-full m-auto object-contain transition-opacity duration-1000 ease-in-out"
                        :class="active === index ? 'opacity-100' : 'opacity-0'"
                    >
                </template>
            </div>
         </div>
    </div>
</div>