@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')

<section class="flex max-md:flex-col max-lg:flex-row items-center justify-center min-h-screen">
    <!-- Gambar Produk -->
    <div class="w-3/5 lg:flex justify-center mb-10 md:hidden">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-md lg:max-w-xl object-contain">
    </div>

    <!-- Form untuk OTP Verification -->
    <div class="w-2/5 bg-[#ACC8DD] px-8 py-[150px] rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center -mt-12">OTP Verification</h2>
        <p class="text-sm text-center mt-4 text-gray-700">Enter your OTP Verification</p>
        @if (session('failed'))
            <div class="text-red-700 mt-10 text-center">{{ session('failed') }}</div>
        @endif
        @if (session('success'))
            <div class="text-green-700 mt-10 text-center">{{ session('success') }}</div>
        @endif
        <form action="{{ $context === 'reset_password' ? route('reset.update', $unique_id) : route('verify.update', $unique_id) }}" method="post" class="space-y-8 mt-12">
            @method('PUT')
            @csrf
            <div class="relative">
                <input type="text" name="otp" placeholder="Enter OTP" class="w-full py-2 px-3 pr-10 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
                <i class='bx bx-envelope-open absolute right-3 top-1/2 -translate-y-1/2 text-gray-500'></i>
            </div>
            @error('otp')
            <small class="text-red-700">{{ $message }}</small>
            @enderror
            <div class="flex justify-between space-x-4 items-center w-full">
                <!-- <a href="{{ $context === 'reset-password' ? route('reset.send_otp', $unique_id) : route('verify.send_otp', $unique_id) }}">Resend OTP</a> -->
                <button class="bg-[#70B9EA] text-white py-3 px-5 w-32 rounded-md text-center text-sm hover:bg-blue-600 transition-colors">Submit</button>
            </div>
            <div class="relative">
            </div>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection 