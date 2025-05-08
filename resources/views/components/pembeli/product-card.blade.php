<!-- resources/views/includes/product-card.blade.php -->
<div class="bg-[#E2D8D8] rounded-lg shadow p-4 text-start relative">
    <a href="{{ route('product.show', $product['id']) }}" class="absolute top-2 right-2 text-gray-700 hover:text-blue-600 text-lg">
        <i class='bx bx-show'></i>
    </a>
    <div class="relative pb-4">
        <img src="{{ asset($product['image_path']) }}" alt="{{ $product['name'] }}" class="mx-auto mb-4 w-32 h-32 object-contain">
    </div>
    <button class="w-full bg-[#373D49] text-white py-1.5 text-sm rounded-none mt-3"
            onclick="addToCart({{ $product['id'] }})">
        Add to Cart
    </button>
    <div class="border-t border-gray-300 pt-1">
        <h4 class="font-semibold text-xs mt-1">{{ $product['name'] }}</h4>
        <p class="text-sm"><span class="text-blue-600 font-bold">Rp.{{ number_format($product['price'], 2) }}</span></p>
    </div>
</div>

<script>
    function addToCart(productId) {
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal menambahkan ke keranjang.');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message); // Ganti jadi notifikasi UI kalau mau
        })
        .catch(error => {
            console.error(error);
            alert('Terjadi kesalahan saat menambahkan produk ke keranjang.');
        });
    }
</script>
<script>
    function addToCart(productId) {
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.message || 'Gagal tambah ke keranjang'); });
            }
            return response.json();
        })
        .then(data => {
            alert(data.message || 'Berhasil ditambahkan ke keranjang!');
        })
        .catch(error => {
            console.error(error);
            alert(error.message || 'Terjadi kesalahan saat menambahkan produk.');
        });
    }
</script>
