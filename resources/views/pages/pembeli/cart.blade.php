@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<nav class="text-sm text-gray-600 px-4 md:px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> /
  <a href="{{ route('detail_product') }}" class="hover:underline text-blue-600">Detail Product</a> /
    <span class="text-gray-800 font-medium">Cart</span>
</nav>

<section class="container mx-auto px-4 py-12">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700 text-left">
                <tr>
                    <th class="py-3 px-4">Product</th>
                    <th class="py-3 px-4">Price</th>
                    <th class="py-3 px-4">Quantity</th>
                    <th class="py-3 px-4">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="py-8 px-4 flex items-center"><img src="{{ asset('image/5.png') }}" alt="" class="w-8 mr-3">TV-LG</td>
                    <td class="py-8 px-4">Rp 65000</td>
                    <td class="py-8 px-4"><input type="number" value="1" min="1" class="w-16 border rounded px-2 py-1"/></td>
                    <td class="py-8 px-4">Rp 65000</td>
                </tr>
                <tr class="border-t">
                    <td class="py-8 px-4 flex items-center"><img src="{{ asset('image/15.png') }}" alt="" class="w-8 mr-3">Refrigerator Mini-Sharp</td>
                    <td class="py-8 px-4">Rp 56000</td>
                    <td class="py-8 px-4"><input type="number" value="2" min="1" class="w-16 border rounded px-2 py-1"/></td>
                    <td class="py-8 px-4">Rp 112000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <button class="mt-4 px-5 py-2 bg-gray-200 rounded hover:bg-gray-300">Update Cart</button>

    <div class="mt-8 bg-white p-6 shadow rounded-md max-w-sm w-full border ml-auto">
        <h3 class="text-2xl font-semibold mb-4">Cart Total</h3>
        <hr class="my-2">
        <div class="flex justify-between font-semibold text-lg mb-4">
            <span>Total:</span>
            <span>Rp 1770000</span>
        </div>
        <a href="{{ route('checkout') }}" class="block w-full bg-sky-400 hover:bg-sky-500 text-white font-medium py-2 rounded text-center">Proceed to checkout</a>
    </div>
</section>
@endsection
