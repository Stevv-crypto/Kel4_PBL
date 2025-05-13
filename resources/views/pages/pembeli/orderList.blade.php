<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Order List</title>
</head>
<body class="bg-gray-100 font-sans">
    @include('components.pembeli.header')

    <div class="container mx-auto px-6 py-4 text-gray-600 text-sm ">
        Home / My Account
    </div>

    <!-- Main -->
    <main class="container mx-auto px-6 flex gap-10 mb-10">

        <!-- Sidebar -->
         <aside class="w-1/4 mt-28">
            <h2 class="font-semibold mb-4">Manage Account</h2>
            <p class="ml-16">My Profile</p>
            <h2 class="font-semibold mb-4 mt-4">My Order</h2>
            <p class="ml-16">List Order</p>
         </aside>

        <!-- Content -->
        <section class="w-3/4 mt-20">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Product</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="border-b">
                            <td class="flex items-center gap-4 py-6 px-6">
                                <img src="image/3.png" class="w-12 ">TV-LG
                            </td>
                            <td class="px-6 py-4">$650</td>
                            <td class="px-6 py-4">
                                <span class="bg-teal-400 text-white py-1 px-5 rounded-lg text-sm">Finish</span>
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="text-gray-700">
                        <tr class="border-b">
                            <td class="flex items-center gap-4 py-6 px-6">
                                <img src="image/3.png" class="w-12 ">TV-LG
                            </td>
                            <td class="px-6 py-4">$650</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500 text-white py-1 px-3 rounded-lg text-sm">Confirm</span>
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="text-gray-700">
                        <tr class="border-b">
                            <td class="flex items-center gap-4 py-6 px-6">
                                <img src="image/3.png" class="w-12 ">TV-LG
                            </td>
                            <td class="px-6 py-4">$650</td>
                            <td class="px-6 py-4">
                                <span class="bg-amber-400 text-white py-1 px-3 rounded-lg text-sm">Process</span>
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="text-gray-700">
                        <tr class="border-b">
                            <td class="flex items-center gap-4 py-6 px-6">
                                <img src="image/3.png" class="w-12 ">TV-LG
                            </td>
                            <td class="px-6 py-4">$650</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-500 text-white py-1 px-3 rounded-lg text-sm">Rejected</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    @include('components.pembeli.footer')
</body>
</html>