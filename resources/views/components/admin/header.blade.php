<header class="bg-[#b0cee3] shadow sticky top-0 z-10">
  <div class="flex items-center justify-between px-4 py-3">
    <!-- Kiri: Sidebar toggle & search -->
    <div class="flex items-center">
      <!-- Button Toggle Sidebar (untuk Mobile) -->
      <button id="toggle-sidebar" class="text-gray-700 focus:outline-none md:hidden">
        <i class="fas fa-bars text-xl"></i>
      </button>

      <!-- Search Input (Desktop) -->
      <div class="relative ml-4 hidden sm:block">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <i class="fas fa-search text-gray-500"></i>
        </span>
        <input class="w-full sm:w-64 rounded-full pl-10 pr-4 py-2 focus:outline-none focus:shadow-outline bg-white" type="text" placeholder="Search">
      </div>
    </div>

    <!-- Kanan: Notifikasi & Profile -->
    <div class="flex items-center space-x-4 md:space-x-6">
      
      <!-- Notifikasi dengan Dropdown -->
      <div class="relative mx-2 sm:mx-4" x-data="{ openNotif: false, showDetail: false }" @click.away="openNotif = false; showDetail = false">
        <button 
          class="flex text-gray-700 focus:outline-none relative"
          @click="openNotif = !openNotif">
          <i class="fas fa-bell text-xl"></i>
          <span class="absolute top-0 right-0 h-5 w-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">
            {{ count($waitingOrders) }}</span>
        </button>

        <!-- Dropdown Notifikasi -->
        <div x-show="openNotif" 
          x-transition class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg overflow-hidden z-20 max-h-[400px] overflow-y-auto"
          style="display: none;">
        <!-- Header -->
        <div class="px-6 py-4 border-b bg-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Order Notification</h2>
        </div>

        <!-- Tampilan Ringkas -->
        @forelse ($waitingOrders as $order)
        <div x-data="{ showDetail: false }" class="border-b"> 
            <!-- Tampilan Ringkas -->
            <div class="px-4 py-2 border-b" x-show="!showDetail" x-transition>
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></div>
                    <div>
                    <h3 class="text-gray-900 font-medium">{{ $order->user->name }}</h3>
                    <p class="text-gray-500 text-sm">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            <div class="mt-4 text-right">
                <button @click="showDetail = true" class="text-blue-600 hover:underline font-medium">Lihat</button>
            </div>
        </div>

        <!-- Tampilan Detail -->
        <div class="p-6 space-y-4" x-show="showDetail" x-transition>
            <div>
                <h3 class="font-semibold text-gray-700">Detail Order</h3>
                <ul class="text-sm text-gray-600 list-disc list-inside mt-2">
                @foreach ($order->orderItems as $item)
                    <li>{{ $item->product->name }}</li>
                    <li>Jumlah: {{ $item->quantity }}</li>
                @endforeach
                <li>Metode Pembayaran: {{ $order->payment->method_name }}</li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Bukti Pembayaran</h4>
                <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti" class="mt-2 w-full rounded-md border" />
            </div>

            <div class="flex justify-end space-x-6 pt-4">
                <form method="POST" action="{{ route('order.reject', $order) }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">✖ Tolak</button>
                </form>
                <form method="POST" action="{{ route('order.confirm', $order) }}">
                    @csrf
                    <button type="submit" class="text-green-600 hover:underline">✔ Konfirmasi</button>
                </form>                
            </div>

            <div class="text-right">
                <button @click="showDetail = false" class="text-sm text-gray-500 hover:underline">⬅ Kembali</button>
            </div>
        </div>
    </div>
        @empty
        <div class="p-6 text-center text-gray-500">
            Tidak ada order baru.
        </div>
        @endforelse
    </div>
  </div>


      <!-- Profile & Dropdown -->
      <div class="relative">
        <button id="user-menu-button" class="flex items-center focus:outline-none">
          <div class="h-8 w-8 overflow-hidden rounded-full bg-gray-300">
            <img class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name=Admin" alt="Avatar">
          </div>
          <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">#</span>
          <svg class="h-5 w-5 text-gray-700 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Account</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Search -->
  <div class="px-4 pb-3 sm:hidden">
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
        <i class="fas fa-search text-gray-500"></i>
      </span>
      <input class="w-full rounded-full pl-10 pr-4 py-2 focus:outline-none focus:shadow-outline bg-white" type="text" placeholder="Search">
    </div>
  </div>
</header>

<script>
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    // Toggle dropdown saat tombol diklik
    userMenuButton.addEventListener('click', (event) => {
        event.stopPropagation(); // ⛔ Hentikan bubbling ke window
        userDropdown.classList.toggle('hidden');
    });

    // Tutup dropdown saat klik di luar
    window.addEventListener('click', (event) => {
        if (!userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
        }
    });
</script>

