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
        // You can implement AJAX request to add product to cart
        // Example:
        /*
        axios.post('/cart/add', {
            product_id: productId,
            quantity: 1
        })
        .then(response => {
            // Handle success
        })
        .catch(error => {
            // Handle error
        });
        */
    }
</script>
