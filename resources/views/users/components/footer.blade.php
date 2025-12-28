{{-- <div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div> --}}

<footer class="bg-gray-900 py-12 mx-auto px-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
    <div>
      <a href="#" class="text-2xl font-bold mb-4 block text-white">
        SiPanda<span class="text-orange-500">.</span>
      </a>
      <p class="text-gray-300 mb-4">
       Belanja mudah dan cepat bersama SiPanda. Semua kebutuhan Anda tersedia dalam satu tempat..
      </p>
      <ul class="flex space-x-4 text-gray-400">
        <li><a href="#"><span class="fa fa-whatsapp"></span></a></li>
        <li><a href="#"><span class="fa fa-instagram"></span></a></li>
        <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
      </ul>
    </div>

    <!-- Links -->
    <div class="md:col-span-2 grid grid-cols-2 sm:grid-cols-2 gap-6">
      <ul class="space-y-2 text-gray-300">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
            {{ __('Shop') }}
        </x-responsive-nav-link>
      </ul>
      <ul class="space-y-2 text-gray-300">
        <x-responsive-nav-link :href="route('aboutus')" :active="request()->routeIs('aboutus')">
            {{ __('About Us') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('contact')">
            {{ __('Contact Us') }}
        </x-responsive-nav-link>
      </ul>
    </div>
  </div>

  <!-- Copyright -->
  <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between text-sm text-gray-400">
    <p class="mb-4 md:mb-0 text-center md:text-left">
      &copy;<script>document.write(new Date().getFullYear());</script> All Rights Reserved. —
      <a href="#" class="text-green-400">IsraAzwa's</a> and Team
    </p>
    <ul class="flex justify-center md:justify-end space-x-6">
      <li><a href="#" class="hover:text-white">Terms &amp; Conditions</a></li>
      <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
    </ul>
  </div>
</footer>