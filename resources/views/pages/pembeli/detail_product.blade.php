@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-4 sm:px-8 md:px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> / 
  <a href="{{ route('tampilKategori', 'rice-cooker') }}" class="hover:underline text-blue-600">Rice Cooker</a> / 
  <span class="text-gray-800 font-medium">Elite Platinum</span>
</nav>

<main class="my-10 px-4 sm:px-6 md:px-10 lg:px-20">
  <div class="flex flex-col md:flex-row gap-10">
    
    <!-- Image Section -->
    <div class="w-full md:w-1/2 bg-gray-100 rounded-lg p-4 flex justify-center items-center">
      <img src="{{ asset('image/15.png') }}" alt="Elite Platinum" class="object-cover max-h-[420px] w-full max-w-md" />
    </div>

    <!-- Product Details -->
    <div class="w-full md:w-1/2 md:pl-10">
      <h2 class="text-2xl font-bold mb-2">Elite Platinum</h2>
      <div class="flex items-center gap-2 text-yellow-500 text-sm mb-2">
        <span class="ml-2 text-green-600 text-sm">50 stock</span>
      </div>
      <p class="text-xl font-sans mb-4">Rp 192000</p>
      <p class="text-gray-700 text-sm leading-relaxed mb-4">
        This electric pressure cooker is a modern cooking experience that utilizes high pressure to speed up the cooking process...
      </p>

      <hr class="my-2">
      <p class="mb-2"><span class="font-medium">Material:</span> Stainless</p>
      <p class="mb-4"><span class="font-medium">Feature:</span> LED digital panels</p>

      <!-- Quantity & Buy Button -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
        <div class="wrapper flex border border-gray-400 rounded overflow-hidden text-black">
          <div class="sub px-4 py-2 text-xl cursor-pointer hover:bg-gray-100">−</div>
          <div class="value w-12 text-center border-l border-r border-gray-400 py-2">2</div>
          <div class="add px-4 py-2 text-xl cursor-pointer bg-blue-500 hover:bg-blue-600 text-white">+</div>
        </div>
        <a href="{{ route('cart') }}" class="w-full sm:w-40 bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 text-center">Add To Cart</a>
      </div>

      <!-- Delivery & Guarantee -->
      <div class="bg-[#b0cee3] p-4 rounded-lg mb-2">
        <div class="flex items-center gap-2 mb-2">
          <i class='bx bx-package text-lg mr-2'></i>
          <span>Free Delivery</span>
        </div>
        <hr>
        <div class="w-full sm:w-fit px-6 py-3 mt-2 rounded text-center border border-gray-500">1 year guarantee</div>
      </div>
    </div>
  </div>
</main>
<script>
    function toggleDropdown() {
      const dropdown = document.getElementById("accountDropdown");
      dropdown.classList.toggle("hidden");
    }
    window.addEventListener("click", function(e) {
      const dropdown = document.getElementById("accountDropdown");
      const profileIcon = document.querySelector(".bx-user");
      if (!dropdown.contains(e.target) && !profileIcon.contains(e.target)) {
        dropdown.classList.add("hidden");
      }
    });

    const sub = document.querySelector(".sub");
    const add = document.querySelector(".add");
    const value = document.querySelector(".value");
    
    let TotalValue = 1;
    value.innerHTML = TotalValue;

    add.onclick = () => {
      TotalValue++;
      value.innerHTML = TotalValue;
    };
    sub.onclick = () => {
      if (TotalValue > 1) {
        TotalValue--;
        value.innerHTML = TotalValue;
      }
    };
  </script>
@endsection
