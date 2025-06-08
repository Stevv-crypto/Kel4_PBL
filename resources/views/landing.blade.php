<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Technocart - Toko Elektronik</title>

    <!-- Font & Tailwind (gunakan vite jika sudah setup) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
    @keyframes slideInLeft {
        0% {
            opacity: 0;
            transform: translateX(-100px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-slide-in-left {
        animation: slideInLeft 1s ease-out forwards;
    }

        </style>
    @endif
</head>
<body class="bg-gray-200 text-gray-800">

    <!-- Hero Section -->
    <header class="relative h-screen bg-cover bg-center" style="background-image: url('image/bgsec1.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex flex-col justify-between h-full">
            <nav class="flex justify-between items-center px-10 py-6 text-white">
                <div class="text-2xl font-bold animate-slide-in-left">E-Technocart</div>
                <div class="space-x-6">
                    <a href="{{ route('tampilLogin') }}" class="hover:underline animate-slide-in-left">Login</a>
                    
                        <a href="{{ route('dataRegister') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 animate-slide-in-left">Register</a>
                    
                </div>
            </nav>
            <div class="flex-grow flex items-center justify-center text-center px-6">
                <div class="text-white max-w-3xl">
                    <h1 class="text-5xl font-bold mb-4 animate-slide-in-left">Toko Online Elektronik Rumah Tangga</h1>
                    <p class="text-xl mb-6 animate-slide-in-left">Belanja elektronik jadi lebih mudah dan terpercaya, dengan pilihan produk terbaik untuk kebutuhan rumah tangga Anda.</p>
                    <a href="{{ route('home_page') }}" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 font-semibold animate-slide-in-left">Belanja Sekarang</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Why Choose Us -->
    <section class="py-20 px-6 lg:px-16 bg-gray-50">
        <div class="flex flex-col lg:flex-row items-center gap-12 max-w-7xl mx-auto">
            <div class="flex items-center justify-center w-full lg:w-1/2">
                <img src="{{ asset('image/shop.png') }}" class="rounded-xl max-h-[600px] w-auto object-contain" alt="TV">
            </div>
            <div class="w-full md:w-1/2">
                <button class="text-sm bg-gray-300 text-gray-500 mb-2 font-medium px-4 py-2 rounded-full">Why</button>
                <h2 class="text-4xl font-light text-gray-900 leading-snug">
                    should you <span class="font-bold border-b-4 border-lime-400">choose</span><br /> E-Technocart
                </h2>
                <div class="mt-8 space-y-6">
                    @php
                        $features = [
                            ['icon' => 'fa-shipping-fast', 'title' => 'Pengiriman Cepat', 'desc' => 'Layanan pengiriman yang efisien dan terpercaya ke seluruh Indonesia.'],
                            ['icon' => 'fa-plug-circle-bolt', 'title' => 'Produk Elektronik Terpercaya', 'desc' => 'Menjual barang elektronik rumah tangga berkualitas dan bergaransi resmi.'],
                            ['icon' => 'fa-comments', 'title' => 'Dukungan Pelanggan yang Responsif', 'desc' => 'Tim kami siap membantu setiap pertanyaan atau kendala pelanggan.']
                        ];
                    @endphp

                    @foreach ($features as $feature)
                        <div class="flex items-start gap-4">
                            <div class="text-blue-600 text-2xl">
                                <i class="fas {{ $feature['icon'] }}"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">{{ $feature['title'] }}</h4>
                                <p class="text-gray-500 text-sm">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-10 relative min-h-screen bg-cover bg-center" style="background-image: url('image/bgteam.png');">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative max-w-6xl mx-auto px-6 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Our Development Team</h2>
            <p class="max-w-2xl mx-auto mb-12">Temui individu-individu berdedikasi di balik aplikasi kami.</p>

            <div class="grid md:grid-cols-4 gap-8">
                @php
                    $teams = [
                        ['img' => 'tepenbg.png', 'name' => 'Steven Samosir'],
                        ['img' => 'ais2.png', 'name' => 'Aisyah Nurwa'],
                        ['img' => 'naylah3.png', 'name' => 'Naylah Amirah'],
                        ['img' => 'Fahmibg.png', 'name' => 'Fahmi Ahmad'],
                    ];
                @endphp

                @foreach ($teams as $team)
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden text-black">
                        <img src="{{ asset('image/' . $team['img']) }}" class="h-64 w-full object-cover" alt="Tim {{ $team['name'] }}">
                        <div class="p-4">
                            <h3 class="font-bold text-xl">{{ $team['name'] }}</h3>
                            <p class="text-gray-500">Frontend and Backend</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Join Section -->
    <section class="py-20 bg-transparent text-black text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-4">Gabung Bersama Kami Sekarang</h2>
            <p class="mb-6">Dapatkan info terbaru, pembaruan fitur, dan berita menarik seputar E-Technocart.</p>
            <a href="{{ route('dataRegister') }}" class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded hover:bg-gray-300">Daftar Sekarang</a>
        </div>
    </section>

</body>
</html>
