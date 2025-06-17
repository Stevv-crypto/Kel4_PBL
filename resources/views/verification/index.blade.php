@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')

<section class="flex max-md:flex-col max-lg:flex-row items-center justify-center min-h-screen">
    <!-- Gambar Produk -->
    <div class="w-3/5 lg:flex justify-center mb-10 md:hidden">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-md lg:max-w-xl object-contain">
    </div>

    <div class="w-2/5 bg-[#ACC8DD] px-8 py-[150px] rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center -mt-12">Verification</h2>
        <p class="text-sm text-center mt-4 text-gray-700">Please verify your account</p>
        @if (session('failed'))
            <div class="text-red-700 mt-10 text-center">{{ session('failed') }}</div>
        @endif

        <form action="/verify" method="post" class="grid justify-items-center mt-4">
            @csrf
            <input type="hidden" value="register" name="type">
            <button type="submit" class="bg-[#70B9EA] text-white py-3 px-5 w-48 rounded-md text-center text-sm hover:bg-blue-600 transition-colors">Send OTP to your email</button>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection 