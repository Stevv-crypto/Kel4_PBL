@extends('layouts.admin')

@section('title', 'Sales Report')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Sales Report</h2>

    @if($sales->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-md">
            Tidak ada data penjualan.
        </div>
    @else
        <div class="overflow-x-auto shadow rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-md overflow-hidden">
                <thead class="bg-blue-100 text-gray-800 font-semibold">
                    <tr>
                        <th class="px-4 py-3 border">Order Code</th>
                        <th class="px-4 py-3 border">Product</th>
                        <th class="px-4 py-3 border">Category</th>
                        <th class="px-4 py-3 border">Merk</th>
                        <th class="px-4 py-3 border">Piece</th>
                        <th class="px-4 py-3 border">Base Price</th>
                        <th class="px-4 py-3 border">Total Price</th>
                        <th class="px-4 py-3 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="border px-4 py-2">{{ $sale->order_code }}</td>
                            <td class="border px-4 py-2">{{ $sale->product }}</td>
                            <td class="border px-4 py-2">{{ $sale->category['name'] ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $sale->merk['name'] ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $sale->piece }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($sale->price_per_piece, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 font-semibold text-green-700">Rp {{ number_format($sale->price_per_piece * $sale->piece, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    {{-- Total --}}
                    <tr class="bg-gray-100 font-bold text-gray-900">
                        <td class="border px-4 py-3 text-right" colspan="6">Total Penjualan</td>
                        <td class="border px-4 py-3 text-green-800">
    <span class="whitespace-nowrap">
        Rp {{ number_format($sales->sum(function($sale) {
            return $sale->price_per_piece * $sale->piece;
        }), 0, ',', '.') }}
    </span>
</td>

                        <td class="border px-4 py-3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    {{-- Tombol print --}}
    <div class="mt-6 text-right print:hidden">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow transition">
            🖨️ Print
        </button>
    </div>
</div>
@endsection
