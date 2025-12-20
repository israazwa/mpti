
<div class="bg-gray-300 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row justify-between gap-12">

      <!-- Text Content -->
      <div class="lg:w-6/12 space-y-6">
        <h2 class="text-3xl font-bold text-gray-900" data-aos="fade-down">Why Choose Us</h2>
        <p class="text-gray-600" data-aos="fade-down">
          Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. 
          Aliquam vulputate velit imperdiet dolor tempor tristique.
        </p>

        <!-- Features Grid -->
        <div class="grid grid-cols-2 gap-8 mt-8">
          <!-- Feature 1 -->
          <div class="space-y-3 reveal-right" data-aos="fade-right">
            <div class="flex justify-center">
              <img src="shipping.png" alt="Fast Shipping" class="h-12 w-12">
            </div>
            <h3 class="text-lg font-semibold text-gray-800 text-center">Fast &amp; Free Shipping</h3>
            <p class="text-md text-gray-600 text-center">
              Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
            </p>
            <p class="text-sm text-gray-400 text-center">
              *Syarat dan Ketentuan Berlaku
            </p>
          </div>

          <!-- Feature 2 -->
          <div class="space-y-3 reveal-right" data-aos="fade-left">
            <div class="flex justify-center">
              <img src="shop.png" alt="Easy to Shop" class="h-12 w-12">
            </div>
            <h3 class="text-lg font-semibold text-gray-800 text-center">Easy to Shop</h3>
            <p class="text-md text-gray-600 text-center">
              Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
            </p>
          </div>

          <!-- Feature 3 -->
          <div class="space-y-3" data-aos="fade-right">
            <div class="flex justify-center">
              <img src="headset.png" alt="Support" class="h-12 w-12">
            </div>
            <h3 class="text-lg font-semibold text-gray-800 text-center">24/7 Support</h3>
            <p class="text-md text-gray-600 text-center">
              Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
            </p>
          </div>

          <!-- Feature 4 -->
          <div class="space-y-3" data-aos="fade-left">
            <div class="flex justify-center">
              <img src="diskon.png" alt="Returns" class="h-12 w-12">
            </div>
            <h3 class="text-lg font-semibold text-gray-800 text-center">Hassle Free Returns</h3>
            <p class="text-md text-gray-600 text-center">
              Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
            </p>
            <p class="text-sm text-gray-400 text-center">
              *Syarat dan Ketentuan Berlaku
            </p>
          </div>
        </div>
        <div class="space-y-6 rounded-md text-center my-5 mx-5">
           <a href="#" data-aos="fade-up"
            class="relative overflow-hidden shadow-sm block w-full my-8 py-4 px-8 rounded-md 
            bg-orange-600 text-white transition hover:bg-orange-700">
            About US
            </a>
            <style>
            a.relative::before {
            content: "";
            position: absolute;
            top: -100%;
            right: -100%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.3), transparent 70%);
            transform: rotate(45deg);
            opacity: 0;
            transition: opacity 1s ease;
            }

            a.relative:hover::before {
            animation: shine 3s forwards;
            opacity: 1;
            }

            @keyframes shine {
            0% {
                top: -100%;
                right: -100%;
            }
            100% {
                top: 100%;
                right: 100%;
            }
            }
            </style>
        </div>
      </div>

      <!-- Image -->
      <div class="lg:w-5/12">
        <x-application-logo class=" w-full h-auto rounded-lg noselect reveal text-red-700 fill-current" />
      </div>

    </div>
  </div>
</div>