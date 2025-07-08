@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> /
  <a href="{{ route('cart') }}" class="hover:underline text-blue-600">Cart</a> /
  <span class="text-gray-800 font-medium">Checkout</span>
</nav>

<section class="bg-gray-50 py-10">
  <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-10">
    <form action="{{ route('checkout.to_payment') }}" method="POST" class="w-full flex flex-col lg:flex-row gap-10">
      @csrf

      @foreach(request('selected_items', []) as $id)
        <input type="hidden" name="selected_items[]" value="{{ $id }}">
      @endforeach

      {{-- Billing Info --}}
      <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Billing Details</h2>
        <div class="space-y-4">
          <div>
            <label class="block mb-1">Name:</label>
            <input type="text" value="{{ $user->name }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1">Address:</label>
            <input type="text" value="{{ $user->address }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1">Phone Number:</label>
            <input type="text" value="{{ $user->phone }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1">Email Address:</label>
            <input type="email" value="{{ $user->email }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
        </div>
      </div>

      {{-- Order Summary --}}
      <div class="w-full lg:w-1/3 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
        <div class="space-y-4 mb-6">
          @foreach ($cart as $item)
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <img src="{{ asset('storage/'. $item->product->image) }}" alt="{{ $item->product->product_name }}" 
                class="w-10 h-10 rounded-md">
              <span class="font-medium">{{ $item->product->name }} x {{ $item->quantity }}</span>
            </div>
            <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
          </div>
          @endforeach
        </div>

        <div class="border-t pt-4 space-y-2">
          <div class="flex justify-between font-semibold text-lg pt-2">
            <span>Total:</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>
        </div>

        <button type="submit" 
          class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md" >
          Place Order
        </button>
      </div>
    </form>
  </div>
</section>

<!--popup-->
@if($showProfileWarning)
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl text-center shadow-xl max-w-md">
      <h2 class="text-xl font-bold text-red-600 mb-4">Complete Your Profile</h2>
      <p class="text-gray-700 mb-6">Please complete your profile information before continuing.</p>
      <a href="{{ route('profile') }}"
         class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
        Complete Now
      </a>
    </div>
  </div>
@endif

@endsection
