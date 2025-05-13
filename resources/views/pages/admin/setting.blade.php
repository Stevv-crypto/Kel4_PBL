<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Settings</title>
</head>
<style>
    /* Tambahkan ini di file CSS */
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}

.hide-scrollbar {
  -ms-overflow-style: none;  /* IE dan Edge */
  scrollbar-width: none;     /* Firefox */
}

</style>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-1/6 bg-[#b0cee3] shadow p-4 space-y-2">
            <div class="flex items-center mb-8">
                <h1 class="logo font-bold text-lg ml-6">E-TechnoCart</h1>
            </div>

            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="dashboard" class="lex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="product" class="flex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                            <i class="fas fa-box mr-3"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="inbox" class="flex items-center p-3 text-gray hover:bg-[#4880FF] rounded-lg">
                            <i class="fas fa-inbox mr-3"></i>
                            <span>Inbox</span>
                        </a>
                    </li>
                    <li>
                        <a href="order_list" class="flex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                            <i class="fas fa-list mr-3"></i>
                            <span>Order Lists</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_product" class="flex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                            <i class="fas fa-cubes mr-3"></i>
                            <span>Manage Product</span>
                        </a>
                    </li>
                </ul>

                <div class="mt-10">
                    <h3 class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-4">MANAGEMENT</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="sales_report" class="flex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                                <i class="fas fa-chart-line mr-3"></i>
                                <span>Sales Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="team" class="flex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                                <i class="fas fa-users mr-3"></i>
                                <span>Team</span>
                            </a>
                        </li>
                        <li>
                            <a href="setting" class="flex items-center p-3 text-white bg-[#4880FF] rounded-lg">
                                <i class="fas fa-cog mr-3"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout" class="flex items-center p-3 text-gray-700 hover:bg-[#4880FF] rounded-lg">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-[#b0cee3] shadow p-4 space-y-2">
                <div class="flex items-center justify-between px-6 py-3">
                    <div class="flex items-center">
                        <button class="text-gray-500 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="relative mx-4 lg:mx-4">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-search text-gray-500"></i>
                            </span>
                            <input class="w-64 rounded-full pl-10 pr-4 py-2 focus:outline-none focus:shadow-outline bg-white" type="text" placeholder="Search">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative mx-4 lg:mx-4">
                            <button class="flex mx-4 text-gray-700 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 h-5 w-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">2</span>
                            </button>
                        </div>

                        <div class="relative">
                            <button class="flex items-center focus:outline-none">
                                <div class="h-8 w-8 overflow-hidden rounded-full bg-gray-300">
                                    <img class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name=Admin" alt="Avatar">
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-700">Admin</span>
                                    <svg class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                            </button>

                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" id="dropdown-menu">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Account</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <h2 class="text-2xl font-semibold ml-6 mb-6 mt-6">General Settings</h2>
            <div class="bg-white rounded-xl shadow-lg w-900 px-6 py-8 mx-6">
                <div class="flex justify-center mb-8">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <button class="text-blue-500 mt-2 text-sm">Upload Logo</button>
                </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-20">
                    <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                    <input type="text" value="E-TechnoCart.com" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Copy Right</label>
                    <input type="text" value="All rights Reserved@E-TechnoCart.com" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 mx-20">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea rows="5" class="w-full  px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 overflow-auto hide-scrollbar">
E-TechnoCart
Jl. Ahmad Yani Batam Kota, Kota Batam,
Kepulauan Riau, Indonesia.
etechnocart02@gmail.com
+6281311590529
                </textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea rows="5" class="w-full  px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
E-TechnoCart Description
                </textarea>
            </div>
            </div>
            
            <div class="flex justify-center mt-10">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-20 py-2 rounded-md">
                    Save
                </button>
            </div>
        </div>

    </div>

    <script>
                // Toggle dropdown menu
                document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.querySelector('button.flex.items-center');
            const dropdownMenu = document.getElementById('dropdown-menu');
            
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            window.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target)) {
                    if (!dropdownMenu.classList.contains('hidden')) {
                        dropdownMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>
</html>