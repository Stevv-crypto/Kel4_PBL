@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Products</h1>
        <button onclick="showAddProductForm()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Product</button>
    </div>
    <div class="overflow-x-auto bg-white shadow">
    <table class="w-full text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Image</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Category</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Warranty</th>
                <th class="p-2 border">Piece</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($products) > 0)
                @foreach($products as $product)
                    <tr class="border-t">
                        <td class="p-2">
                            @if(isset($product['image']))
                                <img src="{{ asset('storage/' . $product['image']) }}" alt="Product Image" class="w-16 h-16 object-cover">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="p-2">{{ $product['name'] }}</td>
                        <td class="p-2">{{ $product['category'] }}</td>
                        <td class="p-2">{{ $product['description'] }}</td>
                        <td class="p-2">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td class="p-2">{{ $product['warranty'] }}</td>
                        <td class="p-2">{{ $product['piece'] }}</td>
                        <td class="flex m-3 items-center gap-2 border border-gray-400 bg-gray-100 rounded w-fit">
                            <button onclick='showEditForm(@json($product))' class="text-blue-600 px-4 py-2"><i class="fa-solid fa-pen-to-square"></i></button>
                            <form action="{{ route('manage_product.destroy', $product['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this product?')" class="text-red-600 w-12 text-center border-l border-gray-400 py-2"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center p-4 text-gray-500">No products available.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

</div>

<!-- Edit Product Form -->
<div id="editForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20">
    <div class="bg-white p-8 rounded-lg w-full max-w-lg relative">
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" />
            <div>
                <label>Image </label>
                <input type="file" name="image" id="edit-image" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Name:</label>
                <input name="name" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Category:</label>
                <input name="category" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Description:</label>
                <textarea name="description" required class="w-full border p-2 rounded"></textarea>
            </div>
            <div>
                <label>Price:</label>
                <input name="price" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Warranty:</label>
                <input name="warranty" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Piece:</label>
                <input name="piece" type="number" min="1" required class="w-full border p-2 rounded" />
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditForm()" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Add New Product Form -->
<div id="addProductForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20">
    <div class="bg-gray-200 p-8 rounded-lg w-full max-w-xl relative ">
        <h2 class="text-xl font-bold mb-6">Add New Product</h2>
        <form method="POST" action="{{ route('manage_product.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label>Image</label>
                <input type="file" name="image" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Name</label>
                <input name="name" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Category</label>
                <input name="category" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" required class="w-full border p-2 rounded"></textarea>
            </div>
            <div>
                <label>Price</label>
                <input name="price" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Warranty</label>
                <input name="warranty" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Piece</label>
                <input name="piece" type="number" min="1" required class="w-full border p-2 rounded" />
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideAddProductForm()" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showEditForm(product) {
        const form = document.getElementById('editForm');
        form.querySelector('form').action = `/admin/manage_product/${product.id}`;
        form.querySelector('input[name="id"]').value = product.id;
        form.querySelector('input[name="name"]').value = product.name;
        form.querySelector('input[name="category"]').value = product.category;
        form.querySelector('textarea[name="description"]').value = product.description;
        form.querySelector('input[name="price"]').value = product.price;
        form.querySelector('input[name="warranty"]').value = product.warranty;
        form.querySelector('input[name="piece"]').value = product.piece;
        form.classList.remove('hidden');
    }
    //function showEditForm() {
      //      document.getElementById('editForm').classList.remove('hidden');
        //  }
    function hideEditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    function showAddProductForm() {
        document.getElementById('addProductForm').classList.remove('hidden');
    }

    function hideAddProductForm() {
        document.getElementById('addProductForm').classList.add('hidden');
    }
</script>
@endsection
