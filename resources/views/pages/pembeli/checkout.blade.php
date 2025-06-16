@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> / 
  <a href="{{ route('cart') }}" class="hover:underline text-blue-600">Cart</a> / 
  <span class="text-gray-800 font-medium">Checkout</span>
</nav>

<section class="bg-gray-50 py-10">
  <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-10">
    <form action="{{ route('checkout.submit') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-10 w-full">
      @csrf

      {{-- Hidden file input agar ikut submit --}}
  <input type="file" name="payment_proof" id="payment_proof_hidden" accept=".jpg,.jpeg,.png,.pdf" style="position:absolute; left:-9999px;" onchange="handleFileUpload(event)" />

  {{-- Error Validation --}}
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
      <ul class="list-disc list-inside text-sm">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

      {{-- Billing Info --}}
      <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Billing Details</h2>
        <div class="space-y-4">
          <div>
            <label class="block mb-1 mt-8">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1 mt-8">Address:</label>
            <input type="text" name="alamat" value="{{ $user->address }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1 mt-8">Phone Number:</label>
            <input type="text" name="nohp" value="{{ $user->phone }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1 mt-8">Email Address:</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div class="flex items-center mt-4">
            <input type="checkbox" class="mr-2" checked disabled>
            <label>Save this information for faster check-out next time</label>
          </div>
        </div>
      </div>

      {{-- Order Summary --}}
      <div class="w-full lg:w-1/3 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
        <div class="space-y-4 mb-6">
          @foreach ($cartItems as $item)
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->product_name }}" class="w-10 h-10 rounded-md">
                <span class="font-medium">{{ $item->product->product_name }} x {{ $item->quantity }}</span>
              </div>
              <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            <input type="hidden" name="selected_items[]" value="{{ $item->code_cart }}">
          @endforeach
        </div>

        <div class="border-t pt-4 space-y-2">
          <div class="flex justify-between font-semibold text-lg pt-2">
            <span>Total:</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>
        </div>

        {{-- Payment Methods --}}
        <div class="mt-6">
          <h3 class="text-xl font-semibold mb-4">Payment Method</h3>

          <div class="mb-4">
            <p class="font-medium mb-2">Bank Transfer:</p>
            <label class="flex items-center space-x-2 mb-2 cursor-pointer">
              <input type="radio" name="payment_method" value="Bank BNI" required>
              <img src="{{ asset('image/bni.png') }}" class="w-10 h-6 object-contain"> <span>BNI</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="payment_method" value="Bank Mandiri">
              <img src="{{ asset('image/mandiri.png') }}" class="w-10 h-6 object-contain"> <span>Mandiri</span>
            </label>
          </div>

          <div class="mt-4">
            <p class="font-medium mb-2">E-Wallet:</p>
            <label class="flex items-center space-x-2 mb-2 cursor-pointer">
              <input type="radio" name="payment_method" value="DANA">
              <img src="{{ asset('image/dana.png') }}" class="w-10 h-6 object-contain"> <span>DANA</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="payment_method" value="OVO">
              <img src="{{ asset('image/ovo.png') }}" class="w-10 h-6 object-contain"> <span>OVO</span>
            </label>
          </div>

          {{-- Include popup modal --}}
          @include('components.pembeli.paymethod', ['payments' => $payments, 'total' => $total])
          
          {{-- Tombol Submit --}}
          <button type="button" onclick="handleSubmit()" class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md">
  Place Order
</button>
          
        </div>
      </div>
    </form>
  </div>
</section>

<script>
  let uploadedFile = null;

  function handleFileUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Preview file
    document.getElementById('fileName').textContent = file.name;
    document.getElementById('fileSize').textContent = formatBytes(file.size);
    document.getElementById('filePreview').classList.remove('hidden');

    // Masukkan file ke input hidden
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    document.getElementById('payment_proof_hidden').files = dataTransfer.files;
  }

  function formatBytes(bytes) {
    const sizes = ['Bytes', 'KB', 'MB'];
    if (bytes === 0) return '0 Byte';
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
  }

  function checkProofBeforeSubmit() {
    const fileInput = document.getElementById('payment_proof_hidden');
    if (!fileInput.files.length) {
      alert('Anda belum meng-upload bukti pembayaran.');
      return false; // cegah submit
    }
    return true; // izinkan submit
  }
  function handleSubmit() {
    if (checkProofBeforeSubmit()) {
      // cari form terdekat dan submit
      document.querySelector('form').submit();
    }
  }
</script>
@endsection
