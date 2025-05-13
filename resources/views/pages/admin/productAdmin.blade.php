@extends('layouts.admin')

@section('title', 'product')

@section('content')
<!-- Products Section -->
      <h2 class="text-2xl font-semibold mb-4">Products</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Product Card -->
        <div class="bg-white rounded-lg shadow p-4">
          <img src="https://source.unsplash.com/200x150?refrigerator" alt="Refrigerator" class="mx-auto">
          <h3 class="mt-2 font-medium">Refrigerator (Sharp)</h3>
          <p class="text-blue-600 font-semibold">$130.00</p>
          <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
          <img src="https://source.unsplash.com/200x150?washingmachine" alt="Washing Machine" class="mx-auto">
          <h3 class="mt-2 font-medium">Washing Machine (Toshiba)</h3>
          <p class="text-blue-600 font-semibold">$80.00</p>
          <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
          <img src="https://source.unsplash.com/200x150?tv" alt="Television" class="mx-auto">
          <h3 class="mt-2 font-medium">Television (LG)</h3>
          <p class="text-blue-600 font-semibold">$100.00</p>
          <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
          <img src="https://source.unsplash.com/200x150?dispenser" alt="Dispenser" class="mx-auto">
          <h3 class="mt-2 font-medium">Dispenser (Polytron)</h3>
          <p class="text-blue-600 font-semibold">$90.00</p>
          <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
          <img src="https://source.unsplash.com/200x150?fan" alt="Fan" class="mx-auto">
          <h3 class="mt-2 font-medium">Fan (Cosmos)</h3>
          <p class="text-blue-600 font-semibold">$30.00</p>
          <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
          <img src="https://source.unsplash.com/200x150?ricecooker" alt="Rice Cooker" class="mx-auto">
          <h3 class="mt-2 font-medium">Rice Cooker (Maspion)</h3>
          <p class="text-blue-600 font-semibold">$90.00</p>
          <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
        </div>
      </div>
    </div>
  </div>
@endsection