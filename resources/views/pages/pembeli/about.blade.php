@extends('layouts.app')

@section('content')

<body class="font-sans bg-white">
  <div class="about-page relative">

    <!-- Breadcrumb -->
    <div class="max-w-4xl mx-auto px-10 flex flex-row items-center gap-3 mt-10">
      <a href="{{ route('home_page') }}" class="text-black hover:underline opacity-50">Home</a>
      <div class="h-4 border-l border-gray-500 opacity-70 transform rotate-45"></div>
      <span class="text-black font-semibold">About Company</span>
    </div>

    <!-- Company Introduction -->
    <div class="flex flex-col md:flex-row items-center justify-between px-10 py-10 max-w-6xl mx-auto">
      <!-- Deskripsi perusahaan -->
      <div class="text-justify max-w-2xl mb-6 md:mb-0">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Tentang E-TechnoCart</h1>
        <p class="text-gray-600 leading-relaxed mb-4">
          E-TechnoCart adalah perusahaan teknologi yang bergerak di bidang penjualan dan distribusi produk elektronik modern. Kami menyediakan beragam produk mulai dari televisi, laptop, smartphone, perangkat rumah pintar, hingga aksesoris elektronik berkualitas tinggi.
        </p>
        <p class="text-gray-600 leading-relaxed mb-4">
          Dengan fokus pada kemudahan dan kepercayaan pelanggan, E-TechnoCart hadir untuk memberikan pengalaman belanja elektronik secara online yang aman, cepat, dan terpercaya.
        </p>
        <p class="text-gray-600 leading-relaxed">
          Kami berkomitmen untuk terus berinovasi dan menjadi mitra teknologi terbaik bagi seluruh masyarakat Indonesia.
        </p>
      </div>
      <!-- Gambar -->
      <div class="ml-0 md:ml-6 max-w-md w-full">
        <img src="{{ asset('images/company-electronics.jpg') }}" alt="Perusahaan Elektronik" class="rounded-lg shadow-md w-full object-cover" />
      </div>
    </div>

    <!-- Misi & Visi -->
    <div class="bg-gray-100 py-10 mt-6">
      <div class="max-w-6xl mx-auto px-8 text-justify">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Visi Kami</h2>
            <p class="text-gray-600 leading-relaxed">
              Menjadi platform e-commerce elektronik terdepan di Indonesia yang inovatif, terpercaya, dan berfokus pada kepuasan pelanggan.
            </p>
          </div>
          <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Misi Kami</h2>
            <ul class="list-disc list-inside text-gray-600 space-y-2 text-justify">
              <li>Menyediakan produk elektronik berkualitas dan bergaransi resmi.</li>
              <li>Menghadirkan pengalaman belanja online yang mudah dan aman.</li>
              <li>Memberikan layanan pelanggan yang responsif dan solutif.</li>
              <li>Terus berinovasi mengikuti perkembangan teknologi.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Nilai Perusahaan -->
    <div class="py-10 px-8 max-w-6xl mx-auto text-justify">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Nilai-Nilai Kami</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Kepercayaan</h3>
          <p class="text-gray-600">Kami menjunjung tinggi integritas dan transparansi dalam setiap transaksi.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Inovasi</h3>
          <p class="text-gray-600">Kami terus mengembangkan layanan dan produk sesuai perkembangan teknologi terbaru.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Kepuasan Pelanggan</h3>
          <p class="text-gray-600">Kami berkomitmen memberikan layanan yang terbaik dan responsif.</p>
        </div>
      </div>
    </div>

  </div>
</body>

@endsection
