@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="mx-20 mb-8 flex max-lg:flex-row max-md:flex-col justify-center items-center min-h-svh">
    <div class="mx-10 flex">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-xl object-cover">
    </div>
    <div class="bg-[#ACC8DD] p-8 rounded-xl shadow-md mx-10 flex flex-col h-full">
        <h2 class="text-xl text-center font-semibold mb-4">Create an account</h2>
        <p class="text-sm text-center mb-4">Enter your details below</p>
        <form class="space-y-4">
            <input type="email" placeholder="Email" class="w-full py-2 text-gray-500 bg-transparent border-0 border-b border-gray-500">
            <input type="password" placeholder="Password" class="w-full py-2 text-gray-500 bg-transparent border-0 border-b border-gray-500">
            <a href="login" class="w-full bg-[#70B9EA] text-white py-2 rounded-md hover:bg-blue-600 inline-block text-center">Create Account</a>
        </form>
        <p class="mt-4 text-sm text-center">Already have account? <a href="login" class="text-blue-600 underline">Login</a></p>
    </div>
</section>
@endsection