<a href="{{ route('product.show', $product->code_product) }}" 
   class="group block bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition duration-300 relative">

    <!-- Gambar Produk -->
    <div class="mb-4">
        @if ($product->image)
            <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}"
                 class="w-full h-20 object-contain mx-auto transition-transform duration-300 group-hover:scale-105" />
        @else
            <div class="w-full h-20 flex items-center justify-center bg-gray-100 text-gray-400 text-sm">
                No Image
            </div>
        @endif
    </div>

    <!-- Info Produk -->
    <div class="text-center">
        <h4 class="text-sm font-semibold text-gray-800 truncate">{{ $product->name }}</h4>
        <p class="text-blue-600 font-bold text-base mt-1">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
        <!-- Stok Produk -->
        <p class="text-sm text-gray-600 mt-1">
            Stok: 
            <span class="{{ ($product->stock && $product->stock->stock > 0) ? 'text-green-600' : 'text-red-600' }}">
                {{ $product->stock->stock ?? 0 }}
            </span>
        </p>
    </div>

    @php
        $stockCount = optional($product->stock)->stock ?? 0;
    @endphp

    <!-- Tombol Add to Cart -->
    <div class="mt-4">
        @if ($stockCount > 0)
            <button onclick="event.stopPropagation(); event.preventDefault(); addToCart('{{ $product->code_product }}')"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center justify-center gap-2">
                <i class='bx bx-cart text-lg'></i> Add to Cart
            </button>
        @else
            <div class="w-full bg-red-400 text-white py-2 rounded-lg text-sm text-center cursor-not-allowed">
                Stok Habis
            </div>
        @endif
    </div>
</a>

<!-- Script Add to Cart -->
<script>
    function addToCart(code_product) {
        fetch(`/cart/add/${code_product}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: 1 })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || 'Gagal tambah ke keranjang');
                });
            }
            return response.json();
        })
        .then(data => {
            alert(data.message || 'Berhasil ditambahkan ke keranjang!');
            // Optional: update badge cart-count kalau kamu punya
            if (data.cartCount !== undefined) {
                const cartSpan = document.querySelector("#cart-count");
                if (cartSpan) cartSpan.textContent = data.cartCount;
            }
        })
        .catch(error => {
            console.error(error);
            alert(error.message || 'Terjadi kesalahan saat menambahkan produk.');
        });
    }
</script>
