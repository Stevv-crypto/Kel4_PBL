@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-4 sm:px-8 md:px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> / 
  <span class="text-gray-800 font-medium">{{ $product['name'] }}</span>
</nav>

<main class="my-10 px-4 sm:px-6 md:px-10 lg:px-20">
  <div class="flex flex-col md:flex-row gap-10">
    
    <!-- Image Section -->
    <div class="w-full md:w-1/2 bg-gray-100 rounded-lg p-4 flex justify-center items-center">
      <img src="{{ asset($product['image_path']) }}" alt="{{ $product['name'] }}" class="object-cover max-h-[420px] w-full max-w-md" />
    </div>

    <!-- Product Details -->
    <div class="w-full md:w-1/2 md:pl-10">
      <h2 class="text-2xl font-bold mb-2">{{ $product['name'] }}</h2>
      <div class="flex items-center gap-2 text-yellow-500 text-sm mb-2">
        <span class="ml-2 text-green-600 text-sm">{{ $product['stock'] }} stock</span> <!-- Display stock dynamically -->
      </div>
      <p class="text-xl font-sans mb-4">Rp {{ number_format($product['price'], 2, ',', '.') }}</p> <!-- Format price dynamically -->
      <p class="text-gray-700 text-sm leading-relaxed mb-4">
        {{ $product['description'] }} <!-- Display product description dynamically -->
      </p>

      <hr class="my-2">
      <p class="mb-2"><span class="font-medium">Category:</span> {{ $product['category'] }}</p> <!-- Display category dynamically -->
      <p class="mb-2"><span class="font-medium">Material:</span> {{ $product['material'] }}</p> <!-- Display material dynamically -->
      <p class="mb-4"><span class="font-medium">Feature:</span> {{ $product['feature'] }}</p> <!-- Display feature dynamically -->

      <!-- Add to Cart Section -->
      <form action="{{ route('cart.add', ['productId' => $product['id']]) }}" method="POST" class="flex items-center gap-4">
        @csrf
        <!-- Hidden Input for Product ID -->
        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
        <!-- Quantity Control -->
        <div class="flex items-center border border-gray-400 rounded overflow-hidden">
          <button type="button" class="sub px-4 py-2 text-xl cursor-pointer hover:bg-gray-100">−</button>
          <div class="value w-12 text-center border-l border-r border-gray-400 py-2">1</div>
          <button type="button" class="add px-4 py-2 text-xl cursor-pointer bg-blue-500 hover:bg-blue-600 text-white">+</button>
        </div>
        <!-- Hidden Input for Quantity -->
        <input type="hidden" name="quantity" id="quantity-input" value="1">
        <!-- Submit Button -->
        <button type="submit" class="w-full sm:w-40 bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 text-center">
          Add To Cart
        </button>
      </form>

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
    const sub = document.querySelector(".sub");
    const add = document.querySelector(".add");
    const value = document.querySelector(".value");
    const quantityInput = document.querySelector("#quantity-input");

    let totalQuantity = 1;
    value.innerHTML = totalQuantity;

    // Decrease quantity when "−" is clicked
    sub.onclick = () => {
      if (totalQuantity > 1) {
        totalQuantity--;
        value.innerHTML = totalQuantity;
        quantityInput.value = totalQuantity; // Update hidden input
      }
    };

    // Increase quantity when "+" is clicked
    add.onclick = () => {
      totalQuantity++;
      value.innerHTML = totalQuantity;
      quantityInput.value = totalQuantity; // Update hidden input
    };
</script>

@endsection
