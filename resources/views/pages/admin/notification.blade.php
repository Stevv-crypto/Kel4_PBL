@extends('layouts.admin')

@section('title', 'Notifikasi Order')

@section('content')

<div x-data="notificationPage()">

    <div class="px-6 py-4">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4">Semua Notifikasi Order</h1>

        @forelse ($waitingOrders as $order)
        <div class="bg-white p-4 rounded-lg shadow-md mb-4 flex justify-between items-center hover:shadow-lg transition">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">{{ $order->user->name }}</h2>
                <p class="text-sm text-gray-500">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                @if ($order->payment)
                    <p class="text-sm text-gray-500">Metode Pembayaran: {{ $order->payment->method_name }}</p>
                @else
                    <p class="text-sm text-gray-500 text-red-500">Metode Pembayaran: Belum memilih</p>
                @endif
                <p class="text-xs text-gray-400">Tanggal: {{ $order->created_at->format('d-m-Y H:i') }}</p>
            </div>

            <div>
             @php
$orderJson = [
    "order_code" => $order->order_code,
    "status" => $order->status,
    "total_price" => $order->total_price,
    "created_at" => $order->created_at->format('Y-m-d H:i:s'), // <-- ini penting!
    "payment" => $order->payment,
    "payment_proof" => $order->payment_proof,
    "order_items" => $order->orderItems->map(function($item) {
        return [
            "quantity" => $item->quantity,
            "product" => [
                "name" => $item->product->name,
            ],
        ];
    })->values(),
];
@endphp


<button 
    @click='showDetail(@json($orderJson))'
    class="text-blue-600 hover:underline text-sm">
    Tampilkan Rincian
</button>


            </div>
        </div>
        @empty
        <div class="text-center text-gray-500">
            Tidak ada notifikasi order.
        </div>
        @endforelse
    </div>

    <!-- ✅ Popup Detail Order -->
<template x-if="openPopup">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-lg max-h-[90vh] overflow-y-auto p-6 rounded-lg shadow-2xl border relative">
            <!-- Tombol Close -->
            <button 
                class="absolute top-3 right-3 text-gray-500 hover:text-black"
                @click="closePopup()">
                <i class="fas fa-times text-lg"></i>
            </button>

            <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-blue-500 pb-3">
                Detail Order
            </h2>

            <template x-if="selectedOrder">
                <div class="space-y-6 bg-white p-6 rounded-xl shadow-md border border-gray-200">

                    <!-- Daftar Produk -->
                    <div>
                        <h3 class="text-lg font-semibold text-blue-700 mb-3 flex items-center">
                            <i class='bx bx-package mr-2 text-blue-500 text-xl'></i>
                            Daftar Produk
                        </h3>
                        <ul class="list-disc list-inside text-sm text-gray-700 pl-2 space-y-2">
                            <template x-for="item in groupedItems()" :key="item.product.name">
                                <li class="ml-1">
                                    <span class="font-medium" x-text="item.product.name"></span>
                                    <span class="text-gray-500"> - Jumlah: </span>
                                    <span x-text="item.quantity"></span>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <!-- Info Pembayaran -->
                    <div>
                        <h3 class="text-lg font-semibold text-blue-700 mb-3 flex items-center">
                            <i class='bx bx-wallet mr-2 text-green-500 text-xl'></i>
                            Info Pembayaran
                        </h3>
                        <div class="text-sm text-gray-700 space-y-1">
                            <p><span class="font-medium">Metode:</span> <span x-text="selectedOrder.payment?.method_name || '-'"></span></p>
                            <p><span class="font-medium">Total:</span> Rp <span x-text="formatNumber(selectedOrder.total_price)"></span></p>
                            <p><span class="font-medium">Tanggal:</span> <span x-text="formatDate(selectedOrder.created_at)"></span></p>
                            <p>
                                <span class="font-medium">Status:</span>
                                <span 
                                    x-text="selectedOrder.status === 'pending_payment' ? 'Belum Membayar' : 'Sudah Membayar'"
                                    :class="selectedOrder.status === 'pending_payment' 
                                        ? 'text-red-600 font-semibold' 
                                        : 'text-green-600 font-semibold'"
                                ></span>
                            </p>
                        </div>
                    </div>

                    <!-- Bukti Pembayaran -->
                    <template x-if="selectedOrder.status === 'waiting'">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-700 mb-3 flex items-center">
                                <i class='bx bx-image mr-2 text-purple-500 text-xl'></i>
                                Bukti Pembayaran
                            </h3>
                            <div class="border rounded-md overflow-hidden">
                                <img :src="'/storage/' + selectedOrder.payment_proof" 
                                    alt="Bukti Pembayaran" 
                                    class="w-full object-contain max-h-96">
                            </div>
                        </div>
                    </template>

                    <!-- Tombol Konfirmasi -->
                    <div class="flex justify-end space-x-6 pt-4">
   <form :action="'/order/reject/' + selectedOrder.order_code" method="POST">
 @csrf
    <button 
        type="submit"
        x-bind:disabled="selectedOrder.status === 'pending_payment'"
        x-bind:class="selectedOrder.status === 'pending_payment' 
            ? 'text-gray-400 cursor-not-allowed' 
            : 'text-red-600 hover:underline'"
    >
        ✖ Tolak
    </button>
</form>

<form :action="'/order/confirm/' + selectedOrder.order_code" method="POST">
    @csrf
    <button 
        type="submit"
        x-bind:disabled="selectedOrder.status === 'pending_payment'"
        x-bind:class="selectedOrder.status === 'pending_payment' 
            ? 'text-gray-400 cursor-not-allowed' 
            : 'text-green-600 hover:underline'"
    >
        ✔ Konfirmasi
    </button>
</form>

</div>

                    
                </div>
            </template>
        </div>
    </div>
</template>


@endsection
@section('scripts')
<script>
    function notificationPage() {
        return {
            openPopup: false,
            selectedOrder: null,

            showDetail(order) {
                this.selectedOrder = order;
                this.openPopup = true;
                console.log(order); // Debug dulu

            },
            closePopup() {
                this.selectedOrder = null;
                this.openPopup = false;
            },
            formatNumber(nominal) {
                if (!nominal) return '0';
                return Number(nominal).toLocaleString('id-ID');
            },
            formatDate(dateString) {
                if (!dateString) return '-';
                let d = new Date(dateString);
                return `${d.getDate().toString().padStart(2, '0')}-${(d.getMonth() + 1).toString().padStart(2, '0')}-${d.getFullYear()} ${d.getHours().toString().padStart(2, '0')}:${d.getMinutes().toString().padStart(2, '0')}`;
            },
            groupedItems() {
                const grouped = {};
                if (!this.selectedOrder || !this.selectedOrder.order_items) return [];

                this.selectedOrder.order_items.forEach(item => {
                    const key = item.product.name;
                    if (!grouped[key]) {
                        grouped[key] = { ...item };
                    } else {
                        grouped[key].quantity += item.quantity;
                    }
                });

                return Object.values(grouped);
            }
        }
    }

</script>
@endsection
