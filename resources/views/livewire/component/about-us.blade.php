<div class="mt-12" x-data="{ activeTab: null }">
    <div class="bg-gray-800 min-h-screen text-gray-100">
        <div class="max-w-5xl mx-auto px-6 py-16">
            <h1 class="text-4xl font-bold text-center mb-8">About Us</h1>
            <p class="text-lg text-center mb-12">
                Kami adalah tim yang berdedikasi untuk menghadirkan solusi digital premium
                dengan fokus pada pengalaman pengguna yang elegan, aman, dan responsif.
            </p>

            <!-- Grid Visi Misi -->
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-gray-700 rounded-lg p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4">Visi Kami</h2>
                    <p class="text-gray-300 leading-relaxed text-justify">
                        Menjadi mitra teknologi yang dipercaya, menghadirkan inovasi yang
                        mendukung bisnis dan kehidupan sehari-hari dengan kualitas terbaik.
                    </p>
                </div>
                <div class="bg-gray-700 rounded-lg p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4">Misi Kami</h2>
                    <ul class="list-disc list-inside text-gray-300 space-y-2">
                        <li>Menciptakan produk digital yang mudah digunakan.</li>
                        <li>Mengutamakan keamanan dan privasi pengguna.</li>
                        <li>Mendukung pertumbuhan bisnis dengan solusi inovatif.</li>
                        <li>Memberikan layanan yang ramah dan profesional.</li>
                    </ul>
                </div>
            </div>

            <!-- Tombol Section -->
            <div class="mt-16 flex flex-wrap justify-center gap-4">
                <button @click="activeTab = 'team'"
                        :class="activeTab === 'team' 
                            ? 'bg-orange-500 text-white shadow-lg' 
                            : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white'"
                        class="px-6 py-3 rounded-lg border border-gray-600 transition duration-300 ease-in-out">
                    Tim Kami
                </button>

                <button @click="activeTab = 'project'"
                        :class="activeTab === 'project' 
                            ? 'bg-orange-500 text-white shadow-lg' 
                            : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white'"
                        class="px-6 py-3 rounded-lg border border-gray-600 transition duration-300 ease-in-out">
                    Latar Belakang
                </button>

                <button @click="activeTab = 'service'"
                        :class="activeTab === 'service' 
                            ? 'bg-orange-500 text-white shadow-lg' 
                            : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white'"
                        class="px-6 py-3 rounded-lg border border-gray-600 transition duration-300 ease-in-out">
                    Teknologi Yang Digunakan
                </button>

                <button @click="activeTab = 'partner'"
                        :class="activeTab === 'partner' 
                            ? 'bg-orange-500 text-white shadow-lg' 
                            : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white'"
                        class="px-6 py-3 rounded-lg border border-gray-600 transition duration-300 ease-in-out">
                    Keamanan Pengguna
                </button>

                <button @click="activeTab = 'contact'"
                        :class="activeTab === 'contact' 
                            ? 'bg-orange-500 text-white shadow-lg' 
                            : 'bg-red-800 text-gray-300 hover:bg-gray-700 hover:text-white'"
                        class="px-6 py-3 rounded-lg border border-gray-600 transition duration-300 ease-in-out">
                    Penting!
                </button>
            </div>

            <!-- Tim -->
            <div class="mt-8"
                 x-show="activeTab === 'team'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-400"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                <section class="relative bg-gray-900 text-gray-100 py-5">
                    <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 opacity-80"></div>
                    <div class="relative max-w-5xl mx-auto px-6">
                        <h2 class="text-4xl font-extrabold text-center mb-3 tracking-wide">
                            Tim Kami
                        </h2>
                        <div class="w-24 h-1 bg-orange-500 mx-auto mb-8 rounded"></div>
                        <div class="bg-gray-800 rounded-xl shadow-lg p-8 space-y-6">
                            <div class="grid md:grid-cols-4 gap-8 mt-8">
                                <!-- Template Card Anggota -->
                                <div class="bg-gray-700 rounded-lg p-6 text-center shadow-lg reveal">
                                    <img src="{{ asset('defaultuser.jpg') }}" alt="Team Member"
                                        class="w-24 h-24 mx-auto rounded-full mb-4">
                                    <h3 class="text-lg font-bold">Ravicenna M</h3>
                                    <p class="text-gray-400">Project Lead</p>
                                    <details class="mt-4 group">
                                        <summary class="cursor-pointer text-gray-200 font-semibold bg-gray-600 rounded-lg p-3">
                                            Detail
                                        </summary>
                                        <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-0 group-open:max-h-40 opacity-0 group-open:opacity-100 bg-gray-600 rounded-lg p-3 mt-2">
                                            <ul class="text-sm text-gray-300 space-y-1">
                                                <li><span class="font-bold"></span>A11.2023.15287</li>
                                                <li><span class="font-bold"></span>Fakultas Ilmu Komputer</li>
                                                <li><span class="font-bold"></span>Teknik Informatika</li>
                                            </ul>
                                        </div>
                                    </details>
                                </div>

                                <div class="bg-gray-700 rounded-lg p-6 text-center shadow-lg reveal">
                                    <img src="{{ asset('defaultuser.jpg') }}" alt="Team Member"
                                        class="w-24 h-24 mx-auto rounded-full mb-4">
                                    <h3 class="text-lg font-bold">Isra Shahzada A</h3>
                                    <p class="text-gray-400">Back-end</p>
                                    <details class="mt-4 group">
                                        <summary class="cursor-pointer text-gray-200 font-semibold bg-gray-600 rounded-lg p-3">
                                            Detail
                                        </summary>
                                        <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-0 group-open:max-h-40 opacity-0 group-open:opacity-100 bg-gray-600 rounded-lg p-3 mt-2">
                                            <ul class="text-sm text-gray-300 space-y-1">
                                                <li><span class="font-bold"></span>A11.2023.15287</li>
                                                <li><span class="font-bold"></span>Fakultas Ilmu Komputer</li>
                                                <li><span class="font-bold"></span>Teknik Informatika</li>
                                            </ul>
                                        </div>
                                    </details>
                                </div>

                                <div class="bg-gray-700 rounded-lg p-6 text-center shadow-lg reveal">
                                    <img src="{{ asset('defaultuser.jpg') }}" alt="Team Member"
                                        class="w-24 h-24 mx-auto rounded-full mb-4">
                                    <h3 class="text-lg font-bold">M. Fallah A</h3>
                                    <p class="text-gray-400">Front-end</p>
                                    <details class="mt-4 group">
                                        <summary class="cursor-pointer text-gray-200 font-semibold bg-gray-600 rounded-lg p-3">
                                            Detail
                                        </summary>
                                        <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-0 group-open:max-h-40 opacity-0 group-open:opacity-100 bg-gray-600 rounded-lg p-3 mt-2">
                                            <ul class="text-sm text-gray-300 space-y-1">
                                                <li><span class="font-bold"></span>A11.2023.15287</li>
                                                <li><span class="font-bold"></span>Fakultas Ilmu Komputer</li>
                                                <li><span class="font-bold"></span>Teknik Informatika</li>
                                            </ul>
                                        </div>
                                    </details>
                                </div>

                                <div class="bg-gray-700 rounded-lg p-6 text-center shadow-lg reveal">
                                    <img src="{{ asset('defaultuser.jpg') }}" alt="Team Member"
                                        class="w-24 h-24 mx-auto rounded-full mb-4">
                                    <h3 class="text-lg font-bold">M. Fabian Rizky F</h3>
                                    <p class="text-gray-400">UI/UX Designer</p>
                                    <details class="mt-4 group">
                                        <summary class="cursor-pointer text-gray-200 font-semibold bg-gray-600 rounded-lg p-3">
                                            Detail
                                        </summary>
                                        <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-0 group-open:max-h-40 opacity-0 group-open:opacity-100 bg-gray-600 rounded-lg p-3 mt-2">
                                            <ul class="text-sm text-gray-300 space-y-1">
                                                <li><span class="font-bold"></span>A11.2023.15287</li>
                                                <li><span class="font-bold"></span>Fakultas Ilmu Komputer</li>
                                                <li><span class="font-bold"></span>Teknik Informatika</li>
                                            </ul>
                                        </div>
                                    </details>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Proyek -->
            <div class="mt-8"
                 x-show="activeTab === 'project'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-400"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-4">
                <div class="">
                    <section class="relative bg-gray-900 text-gray-100 py-2">
                    <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 opacity-80"></div>
                    <div class="relative max-w-5xl mx-auto px-6">
                        
                        <!-- Judul dengan dekorasi -->
                        <h2 class="text-4xl font-extrabold text-center mb-3 tracking-wide">
                            Latar Belakang
                        </h2>
                        <div class="w-24 h-1 bg-orange-500 mx-auto mb-5 rounded"></div>

                        <!-- Konten -->
                        <div class="bg-gray-800 rounded-xl shadow-lg p-8 space-y-6">
                            <p class="text-lg leading-relaxed text-justify">
                                <span class="font-semibold text-orange-400">SiPanda</span> lahir dari semangat untuk menghadirkan solusi digital 
                                yang dapat diakses oleh semua orang. Berawal dari kebutuhan akan platform yang aman, responsif, dan ramah pengguna, 
                                kami membangun fondasi dengan fokus pada kualitas dan inovasi.
                            </p>
                            <p class="text-lg leading-relaxed text-justify">
                                Dengan tim yang berpengalaman di bidang teknologi, desain, dan bisnis, kami berkomitmen untuk mendukung perkembangan 
                                dunia digital di Indonesia. Kami percaya bahwa teknologi bukan hanya tentang sistem, tetapi juga tentang memberikan 
                                pengalaman yang bermakna bagi setiap pengguna.
                            </p>
                            <p class="text-lg leading-relaxed text-justify italic text-gray-400">
                                Proyek ini merupakan bagian dari mata kuliah <span class="font-semibold text-orange-400">Manajemen Proyek Teknologi Informasi (MPTI)</span>, 
                                yang menjadi wadah kami untuk mengasah keterampilan teknis sekaligus manajerial dalam membangun solusi nyata.
                            </p>
                        </div>
                    </div>
                </section>
                </div>
            </div>

            <!-- Layanan -->
            <div class="mt-8"
                 x-show="activeTab === 'service'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-400"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-4">
                <section class="relative bg-gray-900 text-gray-100 py-5">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 opacity-80"></div>
                        <div class="relative max-w-5xl mx-auto px-6">
                            <h2 class="text-4xl font-extrabold text-center mb-3 tracking-wide">
                                Teknologi yang Kami Gunakan
                            </h2>
                            <div class="w-24 h-1 bg-orange-500 mx-auto mb-8 rounded"></div>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="bg-gray-800 rounded-xl shadow-lg p-6 reveal">
                                    <h3 class="text-2xl font-semibold mb-3 text-orange-400">Laravel</h3>
                                    <p class="text-gray-300 leading-relaxed text-justify">
                                        Framework PHP yang menjadi fondasi utama aplikasi kami. 
                                        Laravel memudahkan pengembangan dengan arsitektur MVC, 
                                        routing yang fleksibel, serta integrasi database yang kuat.
                                    </p>
                                </div>
                                <div class="bg-gray-800 rounded-xl shadow-lg p-6 reveal">
                                    <h3 class="text-2xl font-semibold mb-3 text-orange-400">Livewire</h3>
                                    <p class="text-gray-300 leading-relaxed text-justify">
                                        Library untuk membuat komponen interaktif tanpa perlu 
                                        menulis JavaScript secara manual. Livewire menjaga 
                                        pengalaman pengguna tetap responsif dan real-time.
                                    </p>
                                </div>
                                <div class="bg-gray-800 rounded-xl shadow-lg p-6 reveal">
                                    <h3 class="text-2xl font-semibold mb-3 text-orange-400">Alpine.js</h3>
                                    <p class="text-gray-300 leading-relaxed text-justify">
                                        Framework JavaScript ringan yang kami gunakan untuk 
                                        interaktivitas sederhana. Alpine.js membantu membuat 
                                        UI lebih dinamis dengan sintaks yang ringkas.
                                    </p>
                                </div>
                                <div class="bg-gray-800 rounded-xl shadow-lg p-6 reveal">
                                    <h3 class="text-2xl font-semibold mb-3 text-orange-400">Tailwind CSS</h3>
                                    <p class="text-gray-300 leading-relaxed text-justify">
                                        Framework CSS utility-first yang memungkinkan kami 
                                        membangun desain modern, responsif, dan konsisten 
                                        dengan cepat tanpa harus menulis CSS dari nol.
                                    </p>
                                </div>
                                <div class="bg-gray-800 rounded-xl shadow-lg p-6 md:col-span-2 reveal">
                                    <h3 class="text-2xl font-semibold mb-3 text-orange-400">Midtrans API</h3>
                                    <p class="text-gray-300 leading-relaxed text-justify">
                                        Gateway pembayaran yang kami integrasikan untuk 
                                        memproses transaksi secara aman. Midtrans mendukung 
                                        berbagai metode pembayaran dan memastikan pengalaman 
                                        checkout yang lancar bagi pengguna.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
            </div>

            <!-- Partner -->
            <div class="mt-8"
                 x-show="activeTab === 'partner'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-400"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-4">
                <div class="">
                    <section class="relative bg-gray-900 text-gray-100 py-5">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 opacity-80"></div>
                        <div class="relative max-w-5xl mx-auto px-6">
                            <h2 class="text-4xl font-extrabold text-center mb-3 tracking-wide">
                                Keamanan Pengguna
                            </h2>
                            <div class="w-24 h-1 bg-orange-500 mx-auto mb-8 rounded"></div>
                            <div class="bg-gray-800 rounded-xl shadow-lg p-8 space-y-6">
                                <p class="text-lg leading-relaxed text-justify">
                                    Kami menempatkan <span class="font-semibold text-orange-400">keamanan pengguna</span> sebagai prioritas utama. 
                                    Setiap data yang disimpan dalam sistem kami dilindungi dengan standar keamanan modern, 
                                    sehingga pengguna dapat merasa tenang saat menggunakan layanan kami.
                                </p>
                                <p class="text-lg leading-relaxed text-justify">
                                    Bahkan jika terjadi kebocoran database, informasi tetap <span class="font-semibold text-orange-400">aman</span> 
                                    karena seluruh data telah <span class="font-semibold text-orange-400">terenkripsi</span>. 
                                    Enkripsi memastikan bahwa data tidak dapat dibaca atau dimanfaatkan oleh pihak yang tidak berwenang.
                                </p>
                                <p class="text-lg leading-relaxed text-justify">
                                    Jenis enkripsi yang kami gunakan antara lain:
                                </p>
                                <ul class="list-disc list-inside text-gray-300 space-y-2">
                                    <li><span class="font-semibold text-orange-400">Laravel Default Encryption</span> – menggunakan algoritma <code>bcrypt</code> untuk password hashing.</li>
                                    <li><span class="font-semibold text-orange-400">Sodium Encryption</span> – diterapkan pada semua <code>tabel berelasi dengan user </code> untuk melindungi data sensitif dengan kriptografi modern.</li>
                                </ul>
                                <p class="text-lg leading-relaxed text-justify italic text-gray-400">
                                    Dengan pendekatan ini, kami berkomitmen menjaga privasi dan keamanan setiap pengguna, 
                                    sekaligus membangun kepercayaan dalam setiap interaksi digital.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-8"
                 x-show="activeTab === 'contact'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-400"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                    <section class="relative bg-gray-900 text-gray-100 py-4">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 opacity-80"></div>
                        <div class="relative max-w-5xl mx-auto px-6">
                            <h2 class="text-4xl font-extrabold text-center mb-3 tracking-wide">
                                Status Pengembangan
                            </h2>
                            <div class="w-24 h-1 bg-orange-500 mx-auto mb-8 rounded"></div>
                            <div class="bg-gray-800 rounded-xl shadow-lg p-8 space-y-6">
                                <p class="text-lg leading-relaxed text-justify">
                                    Website ini saat ini masih berada dalam tahap <span class="font-semibold text-orange-400">pengembangan</span>. 
                                    Tim kami terus melakukan iterasi dan perbaikan untuk memastikan kualitas terbaik bagi pengguna.
                                </p>
                                <p class="text-lg leading-relaxed text-justify">
                                    Beberapa fitur <span class="font-semibold text-orange-400">non‑kritikal</span> mungkin masih terdapat bug atau belum sempurna, 
                                    namun secara <span class="font-semibold text-orange-400">fungsional</span> website sudah berjalan dengan baik dan dapat digunakan.
                                </p>
                                <p class="text-lg leading-relaxed text-justify italic text-gray-400">
                                    Kami berkomitmen untuk terus meningkatkan performa, memperbaiki bug, dan menambahkan fitur baru 
                                    agar pengalaman pengguna semakin optimal.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
</div>