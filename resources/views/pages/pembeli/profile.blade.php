@extends('layouts.app')

@section('content')

<!-- Wrapper Utama untuk Grid 2 Kolom -->
<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar di Kiri -->
    <div class="w-full md:w-1/3 flex flex-col mt-8 md:mt-12 justify-start items-start gap-8 px-6 md:px-10">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-3">
            <a href="home_page" class="text-black hover:underline opacity-50">Home</a>
            <div class="h-4 border-l border-gray-500 opacity-70 rotate-45"></div>
                <a href="{{ route('profile') }}" class="text-black hover:underline">My Account</a>
            </div>

            <!-- Menu Sections -->
            <div class="flex flex-col items-start gap-6">
                <!-- Manage Account -->
                <div>
                    <span class="text-black font-semibold">Manage My Account</span>
                    <a href="{{ route('profile') }}" class="text-blue-500 hover:underline block">My Profile</a>
                </div>

                <!-- Orders -->
                <div>
                    <span class="text-black font-semibold">My Orders</span>
                    <a href="/orderList" class="text-blue-500 hover:underline block">List Order</a>
                </div>
            </div>
        </div>

        <!-- Form di Kanan -->
        <div class="w-full md:w-2/3 px-6 md:px-0">
            <div class="max-w-2xl mx-auto mt-8 md:mt-10 p-6 bg-white shadow-md rounded-xl">
                <h2 class="text-2xl font-bold mb-6 text-blue-300">Edit Your Profile</h2>

                <form class="space-y-6">

                    <!-- First Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="Name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="Name" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Astore"/>
                        </div>
                        <div>
                            <label for="Phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" id="Phone" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="0812345678" />
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea id="address" rows="4" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 resize-none focus:ring-2 focus:ring-blue-500" placeholder="Jl. Ahmad Yani Batam Kota"></textarea>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="etechnocart02@gmail.com" />
                        </div>
                    </div>

                    <!-- Passwords -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-800">Change Password</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <input type="password" id="currentPassword" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500" />
                            </div>
                            <div>
                                <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                                <input type="password" id="newPassword" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500" />
                            </div>
                            <div>
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input type="password" id="confirmPassword" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500" />
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col md:flex-row justify-end gap-4 mt-4">
                        <button type="button" class="px-6 py-2 bg-gray-500 text-white font-medium rounded-md hover:bg-gray-600 transition">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection