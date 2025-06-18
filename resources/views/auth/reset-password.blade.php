@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<style>
input::-ms-reveal,
input::-ms-clear,
input::-webkit-credentials-auto-fill-button,
input::-webkit-clear-button {
    display: none !important;
}

input[type="password"]::-ms-reveal {
    display: none;
}

input[type="password"]::-webkit-textfield-decoration-container {
    display: none;
}
</style>

<section class="flex max-md:flex-col max-lg:flex-row items-center justify-center min-h-screen">
    <!-- Gambar Produk -->
    <div class="w-3/5 lg:flex justify-center mb-10 md:hidden">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-md lg:max-w-xl object-contain">
    </div>

    <!-- Form Reset Password -->
    <div class="w-2/5 bg-[#ACC8DD] px-8 py-[150px] rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center -mt-12">Reset Password</h2>
        <p class="text-sm text-center mt-4 text-gray-700">Enter a new password</p>

        @if(session('success'))
            <p class="text-green-600 text-sm text-center">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-8 mt-12">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="relative">
                <input id="password" type="password" name="password" placeholder="Masukkan Password" class="form-control w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor- show-password text-gray-500">
                    <i id="password-lock" class="bx bx-lock text-gray-500"></i>
                </span>
            </div>
            @error('password')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror

            <div class="relative">
                <input id="confirm-password" type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor- show-confirm-password text-gray-500">
                    <i id="password-lock" class="bx bx-lock text-gray-500"></i>
                </span>
            </div>
            @error('confirm-password')
                <small class="text-red-700">{{ $message }}</small>
            @enderror

            <div class="flex justify-between space-x-4 items-center w-full">
                <button type="submit"
                    class="bg-[#70B9EA] text-white py-3 px-5 w-32 rounded-md text-center text-sm hover:bg-blue-600 transition-colors">
                    Continue
                </button>
            </div>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.show-password').on('click', function() {
            if($('#password').attr('type') === 'password') {
                $('#password').attr('type', 'text');
                $('#password-lock').attr('class', 'bx bx-lock-open');
            } else{
                $('#password').attr('type', 'password');
                $('#password-lock').attr('class', 'bx bx-lock');
            }
        })
    });

    $(document).ready(function() {
        $('.show-confirm-password').on('click', function() {
            if($('#confirm-password').attr('type') === 'password') {
                $('#confirm-password').attr('type', 'text');
                $('#password-lock').attr('class', 'bx bx-lock-open');
            } else{
                $('#confirm-password').attr('type', 'password');
                $('#password-lock').attr('class', 'bx bx-lock');
            }
        })
    });
</script>

@endsection