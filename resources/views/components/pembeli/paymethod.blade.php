@php
    $mappedPayments = $payments->map(function ($p) {
        return [
            'id' => $p->id,
            'category' => $p->category,
            'method_name' => $p->method_name,
            'account_name' => $p->account_name,
            'account_number' => $p->account_number,
            'logo_path' => $p->logo_path,
        ];
    });
@endphp


<!-- Popup Overlay -->
<div id="popupOverlay"
  class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto animate-slideUp">
    <div class="bg-blue-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
      <h2 class="text-lg font-semibold">Detail Pembayaran</h2>
      <button onclick="closePopup()" class="hover:opacity-80">✕</button>
    </div>

    <div class="px-6 py-4 space-y-5" id="paymentDetailBody">
      {{-- Akan diisi dinamis lewat JS --}}
    </div>

    <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex space-x-3">
      <button type="button" onclick="validateProof()" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded font-medium shadow transition">Kirim Bukti</button>
      <button type="button" onclick="closePopup()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 rounded font-medium transition">Batal</button>
    </div>
  </div>
</div>

<script>

  const allPayments = @json($mappedPayments);
  const totalBayar = {{ $total }};
  let uploadedFile = null;

  function openPopup(method = '') {
    const payment = allPayments.find(p => p.method_name.toLowerCase() === method.toLowerCase());
    const container = document.getElementById('paymentDetailBody');

    if (!payment) {
      container.innerHTML = `<p class="text-red-500">Data metode pembayaran tidak ditemukan.</p>`;
    } else {
      container.innerHTML = `
        <section class="space-y-2">
          <h3 class="text-base font-medium text-gray-700">Bank / E-Wallet Tujuan</h3>
          <div class="flex items-center space-x-3">
            <img src="/${payment.logo_path}" class="w-10 h-10 rounded" />
            <div>
              <p class="text-gray-800 font-semibold">${payment.method_name}</p>
              <p class="text-gray-600 text-sm">A.n. ${payment.account_name}</p>
            </div>
          </div>
          <div class="mt-2 bg-gray-50 p-3 rounded border">
            <p class="text-sm text-gray-500">Nomor Tujuan</p>
            <div class="flex justify-between items-center">
              <p class="font-mono font-semibold text-gray-800">${payment.account_number}</p>
              <button type="button" onclick="copyToClipboard('${payment.account_number}')" class="text-blue-600 hover:text-blue-700">Salin</button>
            </div>
          </div>
        </section>

        <section class="space-y-2">
          <h3 class="text-base font-medium text-gray-700">Instruksi Transfer</h3>
          <div class="bg-gray-50 p-3 rounded border">
            <p class="text-sm text-gray-500">Jumlah yang harus dibayar:</p>
            <p class="text-2xl font-bold text-gray-800">Rp ${totalBayar.toLocaleString('id-ID')}</p>
          </div>
        </section>

        <section class="space-y-2">
          <h3 class="text-base font-medium text-gray-700">Unggah Bukti Pembayaran</h3>
          <label for="fileUpload"
            class="w-full block bg-gray-50 border border-dashed border-gray-300 rounded-md p-4 text-center cursor-pointer hover:border-gray-400 transition">
            <input type="file" id="fileUpload" name="payment_proof" class="hidden" accept=".jpg,.jpeg,.png,.pdf" onchange="handleFileUpload(event)" />
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
      `;
    }

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

  function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
      uploadedFile = file;
      document.getElementById('fileName').textContent = file.name;
      document.getElementById('fileSize').textContent = formatBytes(file.size);
      document.getElementById('filePreview').classList.remove('hidden');
    }
  }

  function removeFile() {
    uploadedFile = null;
    document.getElementById('fileUpload').value = '';
    document.getElementById('filePreview').classList.add('hidden');
  }

  function formatBytes(bytes, decimals = 2) {
    if (!bytes) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(decimals)) + ' ' + sizes[i];
  }

  function validateProof() {
    if (!uploadedFile) {
      alert('Silakan unggah bukti pembayaran terlebih dahulu.');
    } else {
      alert('Bukti berhasil dikirim. Order akan diproses setelah klik "Place Order".');
      closePopup();
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    closePopup();
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
      radio.addEventListener('change', function () {
        openPopup(this.value);
      });
    });
  });
</script>
