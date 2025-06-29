<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100 px-4 md:px-20 py-8">
  <div id="invoice" class="max-w-3xl mx-auto bg-white shadow-md rounded border border-gray-300">
    <!-- Header -->
    <div class="flex justify-between items-center bg-blue-100 px-10 py-4 border-b">
      <h1 class="text-lg font-semibold text-gray-700">E-TechnoCart</h1>
      <span class="font-bold text-gray-800">Invoice</span>
    </div>

    <!-- Order Details -->
    <div class="px-12 py-4">
      <h2 class="text-xl font-bold mb-4">Order Details</h2>
      <div class="space-y-2 text-sm font-semibold text-gray-700">
        <p>Order ID : {{ $order->order_code }}</p>
        <p>Order Date : {{ $order->created_at->format('d M Y', 'H:i') }}</p>
        <p>Name : {{ $order->user->name }}</p>
        <p>Address : {{ $order->user->address }}</p>
        <p>Phone : {{ $order->user->phone }}</p>
        <p>Payment Method : {{ $order->payment->method_name }}</p>
        <p>Status :
          @switch($order->status)
            @case('pending')
              <span class="text-yellow-500">Pending</span>
              @break
            @case('processing')
              <span class="text-blue-500">Processing</span>
              @break
            @case('completed')
              <span class="text-green-600">Completed</span>
              @break
            @case('cancelled')
              <span class="text-red-600">Cancelled</span>
              @break
            @default
              <span class="text-gray-500">{{ ucfirst($order->status) }}</span>
          @endswitch
        </p>
      </div>
    </div>

    <!-- Table -->
    <div class="px-6">
      <div class="overflow-x-auto">
        <table class="w-full text-center shadow-sm rounded overflow-hidden border">
          <thead class="bg-gray-200 text-gray-700 font-semibold text-sm">
            <tr>
              <th class="px-4 py-2">Product</th>
              <th class="px-4 py-2">Quantity</th>
              <th class="px-4 py-2">Price</th>
              <th class="px-4 py-2">Total</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($invoiceProducts as $item)
              <tr class="border-t">
                <td class="flex items-center justify-center gap-2 px-4 py-2">
                  <img src="{{ asset($item->product->image ?? 'placeholder.png') }}" alt="{{ $item->product->name }}" class="w-10 h-10 object-cover rounded" />
                  <span>{{ $item->product->name }}</span>
                </td>
                <td class="px-4 py-2">{{ $item->quantity }}</td>
                <td class="px-4 py-2">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-2">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sub Total -->
    <div class="px-20 py-4 text-right font-semibold text-gray-700">
      <p>Sub Total : Rp{{ number_format($subTotal, 0, ',', '.') }}</p>
    </div>

    <!-- Buttons -->
    <div class="px-6 pb-6 text-right flex flex-wrap justify-end gap-4">
      <button onclick="downloadAsImage()" class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded shadow">
        Download PNG
      </button>
      <button onclick="downloadAsPDF()" class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded shadow">
        Download PDF
      </button>
      <a href="{{ route('order.list') }}">
        <button class="bg-blue-400 hover:bg-blue-500 text-white font-medium px-6 py-2 rounded shadow">
          Done
        </button>
      </a>
    </div>
  </div>

  <script>
    function downloadAsImage() {
      const invoice = document.getElementById('invoice');
      html2canvas(invoice).then(canvas => {
        const link = document.createElement('a');
        link.download = 'invoice.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
      });
    }

    async function downloadAsPDF() {
      const invoice = document.getElementById('invoice');
      const canvas = await html2canvas(invoice);
      const imgData = canvas.toDataURL('image/png');
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF('p', 'pt', 'a4');
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
      pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
      pdf.save('invoice.pdf');
    }
  </script>
</body>
</html>
