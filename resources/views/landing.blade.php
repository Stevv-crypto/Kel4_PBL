<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-Technocart - Toko Elektronik</title>

    <!-- Google Fonts: Playfair Display + Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>



    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #1a202c;
                color: #e2e8f0;
            }

            h1,
            h2,
            h3,
            h4 {
                font-family: 'Playfair Display', serif;
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

            a {
                transition: color 0.3s ease;
            }

            a:hover {
                color: #3b82f6;
            }
        </style>
    @endif
</head>

<body class="bg-gray-900 text-gray-100">

    <!-- Hero Section (DARK) -->
    <header class="relative h-screen bg-cover bg-center" style="background-image: url('image/bgsec1.jpg');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/80"></div>
        <div class="relative z-10 flex flex-col justify-between h-full">
            <nav class="flex justify-between items-center px-10 py-6 text-white">
                <div class="text-3xl font-bold tracking-wide animate-slide-in-left">E-Technocart</div>
                <div class="space-x-8 text-lg font-medium">
                    <a href="{{ route('tampilLogin') }}" class="hover:text-blue-400 animate-slide-in-left">Login</a>
                    <a href="{{ route('dataRegister') }}"
                        class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded-lg animate-slide-in-left transition">Register</a>
                </div>
            </nav>
            <div class="flex-grow flex items-center justify-center text-center px-6">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-bold mb-6 leading-tight animate-slide-in-left drop-shadow-lg">Toko Online
                        Elektronik Rumah Tangga</h1>
                    <p class="text-xl mb-8 font-light animate-slide-in-left drop-shadow-md">Belanja elektronik jadi
                        lebih mudah dan terpercaya, dengan pilihan produk terbaik untuk kebutuhan rumah tangga Anda.</p>
                    <a href="{{ route('home_page') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold animate-slide-in-left transition-shadow shadow-lg hover:shadow-xl">Belanja
                        Sekarang</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Why Choose Us (LIGHT) -->
    <section class="py-20 px-6 lg:px-16 bg-white text-gray-900">
        <div class="flex flex-col lg:flex-row items-center gap-12 max-w-7xl mx-auto">
            <div class="flex items-center justify-center w-full lg:w-1/2">
                <img src="{{ asset('image/shop.png') }}"
                    class="rounded-2xl max-h-[600px] w-auto object-contain shadow-2xl" alt="TV" />
            </div>
            <div class="w-full md:w-1/2">
                <button
                    class="text-sm bg-blue-100 text-blue-600 mb-3 font-semibold px-5 py-2 rounded-full tracking-wide">Why</button>
                <h2 class="text-4xl font-bold leading-snug tracking-tight">
                    should you <span class="font-extrabold text-blue-500 border-b-4 border-blue-400">choose</span><br />
                    E-Technocart
                </h2>
                <div class="mt-10 space-y-8">
                    @php
                        $features = [
                            ['icon' => 'fa-shipping-fast', 'title' => 'Pengiriman Cepat', 'desc' => 'Layanan pengiriman yang efisien dan terpercaya ke seluruh Indonesia.'],
                            ['icon' => 'fa-plug-circle-bolt', 'title' => 'Produk Elektronik Terpercaya', 'desc' => 'Menjual barang elektronik rumah tangga berkualitas dan bergaransi resmi.'],
                            ['icon' => 'fa-comments', 'title' => 'Dukungan Pelanggan yang Responsif', 'desc' => 'Tim kami siap membantu setiap pertanyaan atau kendala pelanggan.'],
                        ];
                    @endphp

                    @foreach ($features as $feature)
                        <div class="flex items-start gap-5">
                            <div class="text-blue-500 text-3xl mt-1">
                                <i class="fas {{ $feature['icon'] }}"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900">{{ $feature['title'] }}</h4>
                                <p class="text-gray-600 text-base leading-relaxed">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team (DARK + MODAL with Taller Cards) -->
<section class="py-20 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-gray-100 relative">
    <div class="absolute inset-0 bg-gradient-to-tr from-blue-900 via-transparent to-purple-900 opacity-40"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-5xl font-extrabold mb-4 tracking-wide font-serif drop-shadow-lg">Development Team</h2>
        <p class="max-w-2xl mx-auto mb-16 text-gray-300 text-lg font-light italic">Temui individu-individu berdedikasi di balik aplikasi kami.</p>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
            @php
                $teams = [
                    ['img' => 'tepenbg.png', 'name' => 'Steven Marcell S', 'role' => 'Leader & Fullstack Developer'],
                    ['img' => 'ais2.png', 'name' => 'Aisyah Nurwa Hida', 'role' => 'Fullstack Developer'],
                    ['img' => 'naylah3.png', 'name' => 'Naylah Amirah A', 'role' => 'Fullstack Developer'],
                    ['img' => 'Fahmibg.png', 'name' => 'Fahmi Ahmad F', 'role' => 'Fullstack Developer'],
                ];
            @endphp

            @foreach ($teams as $team)
                <div x-data="{ open: false }"
                    class="bg-white bg-opacity-10 backdrop-blur-md rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:-translate-y-3 hover:scale-105 cursor-pointer min-h-[28rem] flex flex-col">
                    
                    <img src="{{ asset('image/' . $team['img']) }}" @click="open = true"
                        class="h-64 w-full object-cover object-top filter brightness-90 hover:brightness-110 transition duration-300"
                        alt="Tim {{ $team['name'] }}" />
                    
                    <div class="p-6 text-left flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif font-medium text-xl text-white mb-1 leading-tight">{{ $team['name'] }}</h3>
                            <p class="text-blue-400 text-sm font-medium tracking-wide">{{ $team['role'] }}</p>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div x-show="open" x-transition @click.away="open = false"
                        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
                        
                        <div class="bg-white text-gray-900 rounded-xl shadow-xl p-8 max-w-md w-full relative max-h-[90vh] overflow-y-auto">
                            <button @click="open = false"
                                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>

                            <div class="flex flex-col items-center space-y-4 px-2">
                                <img src="{{ asset('image/' . $team['img']) }}"
                                    class="w-32 h-32 rounded-full object-cover object-top shadow-md ring-4 ring-blue-100 transition duration-300" />
                                <h3 class="text-2xl font-bold text-center">{{ $team['name'] }}</h3>
                                <p class="text-blue-600 text-sm font-medium text-center">{{ $team['role'] }}</p>
                                <p class="text-sm text-gray-700 text-justify leading-relaxed px-1">
                                    @if ($team['name'] === 'Steven Marcell S')
                                        Pemimpin proyek yang bertanggung jawab dalam tim, front-end back-end, dan pengelolaan Git. terlibat UI/UX & Deployment.
                                    @elseif ($team['name'] === 'Aisyah Nurwa Hida')
                                        Menangani fitur frontend dan backend serta menangani role pembeli dari melihat kategori merk hingga membeli barang. Terlibat UI/UX & Deployment.
                                    @elseif ($team['name'] === 'Naylah Amirah A')
                                        Menangani fitur front-end back-end, serta fokus pada sistem transaksi, fitur checkout, validasi form pembayaran. Terlibat UI/UX & Deployment.
                                    @elseif ($team['name'] === 'Fahmi Ahmad F')
                                        Menangani front-end back-end serta berkontribusi di bagian pengaturan admin, sistem pesan pembeli-penjual. Terlibat UI/UX & Deployment.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Highlight Stats (LIGHT) -->
    <section class="py-20 bg-white text-gray-900">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2
                class="text-5xl font-extrabold mb-4 tracking-wide font-serif bg-gradient-to-r from-indigo-600 via-blue-500 to-cyan-400 bg-clip-text text-transparent drop-shadow-md">
                Project Milestones</h2>
            <p class="text-gray-600 mb-16 max-w-2xl mx-auto text-lg font-light">Pencapaian utama selama proses
                pengembangan aplikasi tugas akhir kami.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div
                    class="bg-gradient-to-br from-indigo-50 to-white border border-indigo-200 rounded-2xl p-10 hover:shadow-lg transition duration-300">
                    <div class="text-5xl text-indigo-600 mb-4"><i class="fas fa-code"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Fullstack Development</h3>
                    <p class="text-gray-700 text-base">Aplikasi dibangun menggunakan Laravel untuk backend dan Tailwind
                        CSS untuk frontend.</p>
                </div>
                <div
                    class="bg-gradient-to-br from-blue-50 to-white border border-blue-200 rounded-2xl p-10 hover:shadow-lg transition duration-300">
                    <div class="text-5xl text-blue-600 mb-4"><i class="fas fa-users-cog"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Tim Kolaboratif</h3>
                    <p class="text-gray-700 text-base">Dikerjakan oleh tim beranggotakan 4 mahasiswa dengan pembagian
                        peran yang seimbang.</p>
                </div>
                <div
                    class="bg-gradient-to-br from-cyan-50 to-white border border-cyan-200 rounded-2xl p-10 hover:shadow-lg transition duration-300">
                    <div class="text-5xl text-cyan-600 mb-4"><i class="fas fa-graduation-cap"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Tujuan Edukatif</h3>
                    <p class="text-gray-700 text-base">Dirancang sebagai bagian dari proyek pembelajaran dan tugas
                        project perkuliahan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

</body>

</html>