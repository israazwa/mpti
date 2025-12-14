{{-- <div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
</div> --}}
<!DOCTYPE html>
<html lang="en" x-data="{ showPassword: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-8">
    <!-- Judul -->
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Registrasi User</h2>

    <!-- Form Registrasi -->
    <form action="#" method="POST" class="space-y-4">
      <!-- Nama Lengkap -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" id="name" name="name" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <div class="relative">
          <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2 pr-10">
          <button type="button" @click="showPassword = !showPassword"
            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-orange-500">
            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592m3.592-2.223A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-2.223 3.592m-3.592 2.223A9.956 9.956 0 0112 19c-1.875 0-3.625-.525-5.125-1.425M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Konfirmasi Password -->
      <div>
        <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2">
      </div>

      <!-- Tombol Submit -->
      <button type="submit"
        class="w-full bg-orange-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition-colors">
        Daftar
      </button>
    </form>

    <!-- Link ke Login -->
    <p class="text-sm text-center text-gray-600 mt-4">
      Sudah punya akun?
      <a href="login.html" class="text-orange-500 hover:underline">Login di sini</a>
    </p>
  </div>

</body>
</html>