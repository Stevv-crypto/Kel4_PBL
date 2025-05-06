<header class="header">
            <div class="top-header"></div>
            <div class="navbar flex justify-between items-center bg-[#b0cee3] px-8 py-3">
                <div class="logo font-bold text-lg ml-6">E-TechnoCart</div>

                <nav class="menu flex gap-8 mr-16">
                <a href="#" class="text-black text-base hover:text-gray-700 font-semibold underline">Home</a>
                    <a href="#" class="text-black text-base hover:text-gray-700 hover:underline font-medium">Contact</a>
                    <a href="#" class="text-black text-base hover:text-gray-700 hover:underline font-medium">About</a>
                </nav>

                <div class="actions flex items-center gap-16 ml-24">
                    <div class="search-box relative flex items-center bg-[#e8dedd] rounded px-3 py-1">
                        <input type="text" id="search" placeholder="What are you looking for?"
                            class="bg-transparent border-none text-sm placeholder-gray-500 w-48 px-2 py-1 focus:outline-none" />
                        <i class='bx bx-search icon absolute right-2 text-base text-black'></i>
                    </div>

                    <div class="nav-icon flex items-center gap-6 text-xl text-black">
                        <a href="keranjang.php"><i class='bx bx-cart-alt'></i></a>
                        <a href="javascript:void(0);" onclick="toggleDropdown()"><i class='bx bx-user'></i></a>
                    </div>
                </div>
            </div>
        </header>

         <!-- Akun Dropdown -->
         <div class="account-dropdown absolute right-6 top-20 bg-gray-300/50 border border-gray-300 rounded-lg w-52 shadow-lg z-50 hidden"
            id="accountDropdown">
            <div class="option px-4 py-3 hover:bg-gray-100">
                <a href="profile.php" class="flex items-center gap-3 text-gray-800 text-sm ">
                    <i class='bx bx-user'></i> <span>Manage My Account</span>
                </a>
            </div>
            <div class="option px-4 py-3 hover:bg-gray-100">
                <a href="my-orders.php" class="flex items-center gap-3 text-gray-800 text-sm">
                    <i class='bx bxl-shopify'></i> <span>My Order</span>
                </a>
            </div>
            <div class="option px-4 py-3 hover:bg-gray-100">
                <a href="logout.php" class="flex items-center gap-3 text-red-800 text-sm">
                    <i class='bx bx-log-out'></i> <span>Logout</span>
                </a>
            </div>
        </div>

        <script>
                // Toggle dropdown
                function toggleDropdown() {
                    const dropdown = document.getElementById("accountDropdown");
                    dropdown.classList.toggle("hidden");
                }

                // Close dropdown when clicking outside
                window.addEventListener("click", function (e) {
                    const dropdown = document.getElementById("accountDropdown");
                    const profileIcon = document.querySelector(".bx-user");

                    if (!dropdown.contains(e.target) && !profileIcon.contains(e.target)) {
                        dropdown.classList.add("hidden");
                    }
                });
            </script>