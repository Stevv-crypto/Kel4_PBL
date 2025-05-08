@extends('layouts.app')

@php
    $title = "E-TechnoCart - $category";
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
        @include('components.pembeli.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menambahkan ke keranjang');
            return response.json();
        })
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            alert('Terjadi kesalahan saat menambahkan ke keranjang');
            console.error(error);
        });
    }
</script>
@endpush
