@extends('layouts.app')

@php
    $title = "E-TechnoCart - $category";

    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home_page')],
        ['name' => 'Product', 'url' => '#'],
        ['name' => $category, 'url' => '#']
    ];
@endphp

@section('content')
<section class="mt-2 px-6 sm:px-6 md:px-20">
    <div class="flex justify-between items-center mb-2">
    <h3 class="text-xl font-bold text-gray-900">
        <a href="{{ route('home_page') }}" class="text-blue-600 hover:underline">Home</a> / {{ $category }}
    </h3>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 px-6">
        @foreach ($products as $product)
            <div class="bg-[#E2D8D8] rounded-lg shadow p-4 text-start relative">
                <a href="{{ route('product.show', $product['id']) }}" class="absolute top-2 right-2 text-gray-700 hover:text-blue-600 text-lg">
                    <i class='bx bx-show'></i>
                </a>
                <div class="relative pb-2">
                    <img src="{{ asset($product['image_path']) }}" alt="{{ $product['name'] }}" class="mx-auto mb-4 w-32 h-32 object-contain">
                </div>
                <button class="w-full bg-[#373D49] text-white py-1.5 text-sm rounded-none mt-3">Add to Cart</button>
                <div class="border-t border-gray-300 pt-1">
                    <h4 class="font-semibold text-xs mt-1">{{ $product['name'] }}</h4>
                    <p class="text-sm"><span class="text-blue-600 font-bold">Rp.{{ number_format($product['price'], 2, ',', '.') }}</span></p>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
