@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> / 
  <a href="{{ route('detail_product') }}" class="hover:underline text-blue-600">Detail Produk</a> / 
  <span class="text-gray-800 font-medium">Checkout</span>
</nav>

<section class="bg-gray-50 py-10">
  <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-10">
    {{-- Billing Details --}}
    <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6">Billing Details</h2>
      <form class="space-y-4">
        <div>
          <label class="block mb-1 mt-8">Name</label>
          <input type="text" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div>
          <label class="block mb-1 mt-8">Address</label>
          <input type="text" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div>
          <label class="block mb-1 mt-8">Phone Number</label>
          <input type="text" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div>
          <label class="block mb-1 mt-8">Email Address</label>
          <input type="email" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div class="flex items-center mt-4">
          <input type="checkbox" class="mr-2" checked>
          <label>Save this information for faster check-out next time</label>
        </div>
      </form>
    </div>

    {{-- Order Summary --}}
    <div class="w-full lg:w-1/3 bg-white p-8 rounded-lg shadow-md">
      <div class="space-y-4 mb-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img src="{{ asset('image/5.png') }}" class="w-10 h-10 rounded-md">
            <span class="font-medium">TV-LG</span>
          </div>
          <span>Rp 650000</span>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img src="{{ asset('image/15.png') }}" class="w-10 h-10 rounded-md">
            <span class="font-medium">Refrigerator Mini-Sharp</span>
          </div>
          <span>Rp 650000</span>
        </div>
      </div>

      <div class="border-t pt-4 space-y-2">
        <div class="flex justify-between font-semibold text-lg pt-2">
          <span>Total:</span>
          <span>Rp 1500000</span>
        </div>
      </div>

      <div class="mt-6 space-y-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input type="radio" id="bank" name="payment" class="mr-2">
            <label for="bank">Bank</label>
          </div>
          <div class="flex items-center gap-2">
            <img src="{{ asset('image/bni.png') }}" class="w-10 h-6 object-contain">
            <img src="{{ asset('image/mandiri.png') }}" class="w-10 h-6 object-contain">
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input type="radio" id="ewallet" name="payment" checked class="mr-2">
            <label for="ewallet">E-Wallet</label>
          </div>
          <div class="flex items-center gap-2">
            <img src="{{ asset('image/dana.png') }}" class="w-10 h-6 object-contain">
            <img src="{{ asset('image/ovo.png') }}" class="w-10 h-6 object-contain">  
          </div>
        </div>
      </div>

      <a href="{{ route('home_page') }}" class="mt-6 w-full bg-blue-400 hover:bg-blue-500 text-white font-semibold py-3 rounded-md text-center block">Place Order</a>
    </div>
  </div>
</section>
@endsection
