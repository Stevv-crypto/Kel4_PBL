@extends('layouts.app')

@section('title', 'Home - E-TechnoCart')

@section('content')
<!-- WRAPPER -->
<div class="max-w-screen-xl mx-auto px-4 md:px-6">

    <!-- Hero Section -->
    <section class="relative bg-[#373D49] h-64 flex items-center justify-between px-6 md:px-10 py-6 overflow-hidden rounded-lg shadow-md mb-10">
        <div>
            @if ($latestProduct)
                <h2 class="text-2xl font-semibold text-white">{{ $latestProduct->name }}</h2>
                <p class="text-lg text-blue-300 font-bold">New Products!!!</p>
                <a href="{{ route('product.show', $latestProduct->code_product) }}">
                    <button class="mt-6 bg-red-600 text-white px-4 py-2 text-sm rounded hover:bg-red-700 transition">Shop Now</button>
                </a>
            @else
                <h2 class="text-2xl font-semibold text-white">No New Products</h2>
            @endif
        </div>

        @if ($latestProduct && $latestProduct->image)
            <img src="{{ asset('storage/' . $latestProduct->image) }}" 
                alt="{{ $latestProduct->name }}" 
                class="w-40 md:w-56 lg:w-64 max-h-48 object-contain shadow-lg" />
        @elseif ($latestProduct && $latestProduct->merk && $latestProduct->merk->logo)
            <img src="{{ asset('storage/logos/' . $latestProduct->merk->logo) }}" 
                alt="{{ $latestProduct->merk->name }}" 
                class="w-40 md:w-56 lg:w-64 max-h-48 object-contain shadow-lg" />
        @else
            <img src="{{ asset('image/20.png') }}" 
                alt="Default Banner" 
                class="w-40 md:w-56 lg:w-64 max-h-48 object-contain shadow-lg" />
        @endif
    </section>

    <!-- Product Section -->
    <section class="mt-12">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900">Explore Products</h3>
            <div class="space-x-2">
                <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300 transition"><i class='bx bx-left-arrow-alt'></i></button>
                <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300 transition"><i class='bx bx-right-arrow-alt'></i></button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                @include('components.pembeli.product-card', ['product' => $product])
            @endforeach
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('products') }}" 
                class="bg-blue-100 text-blue-700 px-6 py-2 rounded-lg hover:bg-blue-200 inline-block transition">
                View All Products
            </a>
        </div>
    </section>

</div> <!-- END WRAPPER -->
@endsection
