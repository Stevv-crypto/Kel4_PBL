@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<nav class="text-sm text-gray-600 px-4 md:px-14 mt-4 py-2">
    <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> /
    <span class="text-gray-800 font-medium">Cart</span>
</nav>

@if($cart->isEmpty())
    <div class="text-center text-gray-600 py-12">
        Keranjang kamu kosong 😢 <br>
        <a href="{{ route('home_page') }}" class="text-blue-600 hover:underline">Belanja Sekarang</a>
    </div>
@else
<div class="overflow-x-auto mt-4">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200 text-gray-700 text-left">
            <tr>
                <th class="py-3 px-4"></th>
                <th class="py-3 px-4">Product</th>
                <th class="py-3 px-4">Price</th>
                <th class="py-3 px-4">Quantity</th>
                <th class="py-3 px-4">Subtotal</th>
                <th class="py-3 px-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                @php
                    $product = $item->product;
                    $stock = optional($product->stock)->stock ?? 0;
                    $isOutOfStock = $stock === 0;
                    $isLimited = $stock <= $item->quantity;
                @endphp

                <tr class="border-t {{ $isOutOfStock ? 'opacity-50 pointer-events-none' : '' }}">
                    <td class="py-4 px-4 text-center">
                        @if ($isOutOfStock)
                            <input type="checkbox" disabled class="cursor-not-allowed opacity-50">
                        @else
                            <input type="checkbox" class="item-checkbox" value="{{ $item->code_cart }}" data-subtotal="{{ $item->subtotal }}">
                        @endif
                    </td>
                    <td class="py-4 px-4 flex items-center">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 mr-3 rounded shadow">
                        <div>
                            <div>{{ $product->name }}</div>
                            @if ($isOutOfStock)
                                <div class="text-red-600 text-sm mt-1">Stok habis, produk tidak tersedia.</div>
                            @elseif ($isLimited)
                                <div class="text-yellow-500 text-sm mt-1">Stok terbatas, tidak bisa tambah lagi.</div>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 px-4">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="py-4 px-4">
                        @if ($isOutOfStock)
                            <input type="number" value="{{ $item->quantity }}" class="w-16 border rounded px-2 py-1 text-center bg-gray-100" readonly>
                        @else
                            <input type="number" 
                                name="quantity" 
                                min="1"
                                max="{{ $stock }}"
                                value="{{ $item->quantity }}" 
                                data-code="{{ $product->code_product }}"
                                class="w-16 border rounded px-2 py-1 text-center quantity-input"
                            />
                        @endif
                    </td>

                    <td class="py-4 px-4">Rp {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                    <td class="py-4 px-8">
                        <form action="{{ route('cart.remove', ['code_product' => $product->code_product]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 pointer-events-auto">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Cart Total Section and Checkout Button -->
<div class="mt-8 bg-white p-6 shadow rounded-md max-w-sm w-full border ml-auto">
    <h3 class="text-2xl font-semibold mb-4">Cart Total</h3>
    <hr class="my-2">
    <div class="flex justify-between font-semibold text-lg mb-4">
        <span>Total:</span>
        <span id="total-price">Rp 0,00</span>
    </div>

    <form id="cart-form" action="{{ route('checkout.show') }}" method="GET">
        @csrf
        <div id="hidden-inputs"></div>
        <button type="submit" class="block w-full bg-sky-400 hover:bg-sky-500 text-white font-medium py-2 rounded text-center mt-4">
            Proceed to checkout
        </button>
    </form>
</div>
@endif

<!-- JS untuk menghitung total berdasarkan checkbox -->
<script>
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const totalPriceElement = document.getElementById('total-price');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');
    const quantityInputs = document.querySelectorAll('.quantity-input');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 2
        }).format(angka);
    }

    function updateTotal() {
        let total = 0;
        hiddenInputsContainer.innerHTML = '';

        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.dataset.subtotal);

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'selected_items[]';
                hiddenInput.value = cb.value;
                hiddenInputsContainer.appendChild(hiddenInput);
            }
        });

        totalPriceElement.textContent = formatRupiah(total);
    }

    // Event: checkbox berubah
    checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    document.addEventListener('DOMContentLoaded', updateTotal);

    // Event: quantity diubah
    quantityInputs.forEach(input => {
        input.addEventListener('change', () => {
            const newQuantity = parseInt(input.value) || 1;
            const code = input.dataset.code;

            fetch(`/cart/update/${code}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = input.closest('tr');
                    const subtotalCell = row.querySelector('td:nth-child(5)');
                    subtotalCell.textContent = formatRupiah(data.new_subtotal);

                    const checkbox = row.querySelector('.item-checkbox');
                    if (checkbox) {
                        checkbox.dataset.subtotal = data.new_subtotal;
                    }

                    updateTotal();
                } else {
                    alert(data.message || 'Gagal update kuantitas');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat update kuantitas');
            });
        });
    });
</script>

@endsection
