@extends('layouts.admin')

@section('title', 'Order')

@section('content')
<div class="space-y-6">
  <h2 class="text-2xl font-bold">Order Lists</h2>

  <div class="bg-white shadow rounded-lg p-4 overflow-auto">
    <table class="w-full text-left border-collapse text-sm">
      <thead>
        <tr class="bg-gray-100 text-xs">
          <th class="p-3">Order Code</th>
          <th class="p-3">Customer</th>
          <th class="p-3">Address</th>
          <th class="p-3">Date</th>
          <th class="p-3">Product</th>
          <th class="p-3">Category</th>
          <th class="p-3">Merk</th>
          <th class="p-3">Piece</th>
          <th class="p-3">Payment</th>
          <th class="p-3">Payment Proof</th>
          <th class="p-3">Total</th>
          <th class="p-3">Status</th>
        </tr>
      </thead>
      <tbody>
       @foreach($orders as $order)
<tr class="border-t">
  <td class="p-3">{{ $order->order_code }}</td>
  <td class="p-3">{{ $order->user->name }}</td>
  <td class="p-3">{{ $order->user->address }}</td>
  <td class="p-3">{{ $order->created_at->format('Y-m-d') }}</td>
<td class="p-3">
  <div class="space-y-1">
    @foreach($order->orderItems as $item)
      <div>{{ $item->product ? $item->product->name : 'Product not found' }}</div>
    @endforeach
  </div>
</td>

<td class="p-3">
  <div class="space-y-1">
    @foreach($order->orderItems as $item)
      <div>{{ $item->product->category->name ?? 'N/A' }}</div>
    @endforeach
  </div>
</td>

<td class="p-3">
  <div class="space-y-1">
    @foreach($order->orderItems as $item)
      <div>{{ $item->product->merk->name ?? 'N/A' }}</div>
    @endforeach
  </div>
</td>

<td class="p-3">
  <div class="space-y-1">
    @foreach($order->orderItems as $item)
      <div>{{ $item->quantity }}</div>
    @endforeach
  </div>
</td>

  <td class="p-3">
    <strong>{{ $order->payment->method_name ?? 'N/A' }}</strong><br>
    <small>{{ $order->payment->account_number }}</small>
  </td>
  <td class="p-3">
    @if($order->payment_proof)
      <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Proof" class="w-16 h-16 object-cover rounded border">
      </a>
    @else
      <span class="text-gray-400 italic">No proof</span>
    @endif
  </td>
  <td class="p-3">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
  <td class="p-3">
    <form action="{{ route('order.updateStatus', $order) }}" method="POST">
  @csrf
  <select name="status" onchange="this.form.submit()" class="text-sm rounded px-2 py-1 border bg-white">
    <option value="processing" @selected($order->status == 'processing')>Processing</option>
    <option value="sent" @selected($order->status == 'sent')>Sent</option>
    <option value="complete" @selected($order->status == 'complete')>Complete</option>
    <option value="rejected" @selected($order->status == 'rejected')>Rejected</option>
  </select>
</form>

  </td>
</tr>
@endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
