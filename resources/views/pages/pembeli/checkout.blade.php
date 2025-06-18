@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> /
  <a href="{{ route('cart') }}" class="hover:underline text-blue-600">Cart</a> /
  <span class="text-gray-800 font-medium">Checkout</span>
</nav>

<section class="bg-gray-50 py-10">
  <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-10">
    <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col lg:flex-row gap-10">
      @csrf

      @foreach(request('selected_items', []) as $id)
        <input type="hidden" name="selected_items[]" value="{{ $id }}">
      @endforeach

      {{-- Billing Info --}}
      <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Billing Details</h2>
        <div class="space-y-4">
          <div>
            <label class="block mb-1">Name:</label>
            <input type="text" value="{{ $user->name }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1">Address:</label>
            <input type="text" value="{{ $user->address }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1">Phone Number:</label>
            <input type="text" value="{{ $user->phone }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1">Email Address:</label>
            <input type="email" value="{{ $user->email }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
        </div>
      </div>

      {{-- Order Summary + Payment --}}
      <div class="w-full lg:w-1/3 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
        <div class="space-y-4 mb-6">
          @foreach ($cart as $item)
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->product_name }}" class="w-10 h-10 rounded-md">
              <span class="font-medium">{{ $item->product->name }} x {{ $item->quantity }}</span>
            </div>
            <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
          </div>
          @endforeach
        </div>

        <div class="border-t pt-4 space-y-2">
          <div class="flex justify-between font-semibold text-lg pt-2">
            <span>Total:</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>
        </div>

        {{-- Payment Method --}}
        <div class="mt-6">
          <h3 class="text-xl font-semibold mb-4">Payment Method</h3>
          <p class="font-medium mb-2">Bank Transfer:</p>
@foreach ($paymentMethods->where('category', 'bank') as $payment)
  <label class="flex items-center space-x-2 mb-2 cursor-pointer">
    <input type="radio" name="payment_method"
           value="{{ $payment->id }}"
           onclick="updateBankDetails(this)"
           data-bank-name="{{ $payment->method_name }}"
           data-account-name="{{ $payment->account_name }}"
           data-account-number="{{ $payment->account_number }}"
           data-logo="{{ asset($payment->logo_path) }}"
           required>
    <img src="{{ asset($payment->logo_path) }}" class="w-10 h-6 object-contain">
    <span>{{ $payment->method_name }}</span>
  </label>
@endforeach

<p class="font-medium mt-4 mb-2">E-Wallet:</p>
@foreach ($paymentMethods->where('category', 'e-wallet') as $payment)
  <label class="flex items-center space-x-2 mb-2 cursor-pointer">
    <input type="radio" name="payment_method"
           value="{{ $payment->id }}"
           onclick="updateBankDetails(this)"
           data-bank-name="{{ $payment->method_name }}"
           data-account-name="{{ $payment->account_name }}"
           data-account-number="{{ $payment->account_number }}"
           data-logo="{{ asset($payment->logo_path) }}">
    <img src="{{ asset($payment->logo_path) }}" class="w-10 h-6 object-contain">
    <span>{{ $payment->method_name }}</span>
  </label>
@endforeach

        </div>

        {{-- Upload Modal --}}
        <input type="hidden" name="payment_method" id="selectedPaymentMethod">
        <button type="submit" class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md disabled:opacity-50" id="submitOrderBtn" disabled>
          Place Order
        </button>
      </div>
      {{-- Modal Section --}}
<div id="popupOverlay" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto animate-slideUp">
    <div class="bg-blue-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
      <h2 class="text-lg font-semibold">Detail Pembayaran</h2>
      <button type="button" onclick="closePopup()" class="hover:opacity-80">✕</button>
    </div>

    <div class="px-6 py-4 space-y-5">
      <section class="space-y-2">
        <h3 class="text-base font-medium text-gray-700">Bank Tujuan</h3>
        <div class="flex items-center space-x-3">
          <img id="bankLogo" src="" class="w-10 h-10 object-contain bg-white rounded border p-1">
          <div>
            <p id="bankName" class="text-gray-800 font-semibold">-</p>
            <p id="accountName" class="text-gray-600 text-sm">A.n. -</p>
          </div>
        </div>
        <div class="mt-2 bg-gray-50 p-3 rounded border">
          <p class="text-sm text-gray-500">Nomor Rekening</p>
          <div class="flex justify-between items-center">
            <p id="accountNumber" class="font-mono font-semibold text-gray-800">-</p>
            <button type="button" onclick="copyToClipboard(document.getElementById('accountNumber').textContent)" class="text-blue-600 hover:text-blue-700">
              Salin
            </button>
          </div>
        </div>
      </section>

      <section class="space-y-2">
        <h3 class="text-base font-medium text-gray-700">Instruksi Transfer</h3>
        <div class="bg-gray-50 p-3 rounded border">
          <p class="text-sm text-gray-500">Jumlah yang harus dibayar:</p>
          <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>
      </section>

      <section class="space-y-2">
        <h3 class="text-base font-medium text-gray-700">Unggah Bukti Pembayaran</h3>
        <label for="payment_proof" class="w-full block bg-gray-50 border border-dashed border-gray-300 rounded-md p-4 text-center cursor-pointer hover:border-gray-400 transition">
          <input type="file" id="payment_proof" name="payment_proof" class="hidden" accept=".jpg,.jpeg,.png,.pdf" required>
          <p class="text-gray-500 text-sm">Klik atau tarik file (JPG, PNG, PDF – max 5MB)</p>
        </label>
        <div id="filePreview" class="hidden bg-gray-50 p-3 rounded border flex justify-between items-center">
          <div>
            <p id="fileName" class="font-semibold text-gray-800"></p>
            <p id="fileSize" class="text-sm text-gray-500"></p>
          </div>
          <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-600">Hapus</button>
        </div>
      </section>
    </div>

    <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex space-x-3">
      <button type="button" onclick="closePopup()" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded font-medium shadow transition">
        Kirim Bukti
      </button>
      <button type="button" onclick="closePopup()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 rounded font-medium transition">
        Batal
      </button>
    </div>
  </div>
</div>
    </form>
  </div>
</section>



{{-- Script --}}
<script>
  const fileInput = document.getElementById('payment_proof');
  const filePreview = document.getElementById('filePreview');
  const submitBtn = document.getElementById('submitOrderBtn');

  function openPopup() {
    document.getElementById('popupOverlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closePopup() {
    document.getElementById('popupOverlay').classList.add('hidden');
    document.body.style.overflow = 'auto';
  }

  function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => alert('Tersalin ke clipboard!'));
  }

  function removeFile() {
    fileInput.value = '';
    filePreview.classList.add('hidden');
    submitBtn.setAttribute('disabled', true);
  }

  fileInput?.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      document.getElementById('fileName').textContent = file.name;
      document.getElementById('fileSize').textContent = formatBytes(file.size);
      filePreview.classList.remove('hidden');
      submitBtn.removeAttribute('disabled');
    } else {
      removeFile();
    }
  });

  function formatBytes(bytes, decimals = 2) {
    if (!bytes) return '0 Bytes';
    const k = 1024, dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
  }

  function updateBankDetails(radio) {
    document.getElementById('selectedPaymentMethod').value = radio.value;
    document.getElementById('bankName').textContent = radio.dataset.bankName;
    document.getElementById('accountName').textContent = 'A.n. ' + radio.dataset.accountName;
    document.getElementById('accountNumber').textContent = radio.dataset.accountNumber;
    document.getElementById('bankLogo').src = radio.dataset.logo;
    openPopup();
  }
</script>
@endsection
