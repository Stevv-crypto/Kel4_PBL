<header class="top-0 z-1000">
    <div class="flex justify-between items-center bg-[#b0cee3] px-6 py-3">

        <!-- Logo -->
        <div class="logo font-bold text-lg">E-TechnoCart</div>

        <!-- Hamburger Menu Icon (mobile) -->
        <div class="md:hidden text-2xl cursor-pointer" onclick="toggleMobileMenu()">
            <i class='bx bx-menu'></i>
        </div>

        <!-- Desktop Menu -->
        <nav class="menu hidden md:flex gap-8 items-center">
            <a href="{{ route('home_page') }}" class="text-black text-base hover:text-gray-700 hover:underline font-medium">Home</a>
            <a href="{{ route('chat.index') }}" class="text-black text-base hover:text-gray-700 hover:underline font-medium">Contact</a>
            <a href="{{ route('about') }}" class="text-black text-base hover:text-gray-700 hover:underline font-medium">About</a>

            <!-- Dropdown Categories -->
            <div id="categoryDropdownContainer" class="relative">
                <button
                    id="categoryDropdownBtn"
                    tabindex="0"
                    class="text-black text-base font-medium flex items-center gap-1 hover:text-gray-700 hover:underline focus:outline-none"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    Categories
                    <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div
                    id="categoryDropdown"
                    class="absolute left-0 mt-2 w-48 bg-white border border-gray-300 rounded shadow-lg opacity-0 invisible transition-opacity z-50 dark:bg-gray-700 dark:border-gray-600"
                    role="menu"
                    aria-labelledby="categoryDropdownBtn"
                >
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('category.show', $category->code) }}"
                                    class="flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600"
                                    role="menuitem">
                                    <span>{{ ucfirst($category->name) }}</span>
                                    <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Search & Actions -->
        <form action="{{ route('search') }}" method="GET" class="search-box relative flex items-center bg-[#e8dedd] rounded px-3 py-1">
            <input type="text" name="query" placeholder="What are you looking for?"
                class="bg-transparent border-none text-sm placeholder-gray-500 w-48 px-2 py-1 focus:outline-none" />
            <button type="submit"><i class='bx bx-search icon absolute right-2 text-base text-black'></i></button>
        </form>
        <!-- ini yang baru untuk notifikasi produk masuk ke keranjang  -->
        <div class="nav-icon flex items-center gap-6 text-xl text-black">
            <a href="{{ route('cart') }}" class="relative">
                <i class='bx bx-cart-alt'></i>
                @if($cartCount > 0)
                    <span id="cart-count" class="absolute -top-2 -right-2 h-5 w-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">
                        {{ $cartCount }}
                    </span>
                @else
                    <span id="cart-count" class="absolute -top-2 -right-2 h-5 w-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hidden">
                        0
                    </span>
                @endif
            </a>
            <a href="javascript:void(0);" onclick="toggleDropdown()"><i class='bx bx-user'></i></a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="hidden flex flex-col gap-4 bg-[#b0cee3] px-6 py-4 md:hidden border-t border-gray-300">

        <a href="{{ route('home_page') }}" class="text-black text-base font-medium">Home</a>
        <a href="{{ route('chat.index') }}" class="text-black text-base font-medium">Contact</a>
        <a href="{{ route('about') }}" class="text-black text-base font-medium">About</a>

        <!-- Mobile Categories Dropdown -->
        <details class="group">
            <summary class="cursor-pointer text-black text-base font-medium list-none flex justify-between items-center">
                Categories
                <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>
            <ul class="mt-2 pl-4">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->code) }}"
                            class="block py-1 text-black hover:text-gray-700 dark:text-gray-200 dark:hover:text-gray-400">
                            {{ ucfirst($category->name) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </details>

        <form action="{{ route('search') }}" method="GET" class="search-box relative flex items-center bg-[#e8dedd] rounded px-3 py-1">
            <input type="text" name="query" placeholder="What are you looking for?"
                class="bg-transparent border-none text-sm placeholder-gray-500 w-48 px-2 py-1 focus:outline-none" />
            <button type="submit"><i class='bx bx-search icon absolute right-2 text-base text-black'></i></button>
        </form>

        
        <div class="flex items-center gap-6 text-xl text-black mt-2">
            <a href="{{ route('cart') }}"><i class='bx bx-cart-alt'></i>
            <span class="absolute top-0 right-0 h-5 w-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">2</span></a>
            <a href="javascript:void(0);" onclick="toggleDropdown()"><i class='bx bx-user'></i></a>
        </div>
    </div>

    <!-- Akun Dropdown -->
    <div id="accountDropdown"
        class="account-dropdown absolute right-6 top-20 bg-gray-300/50 border border-gray-300 rounded-lg w-52 shadow-lg z-50 hidden">
        <div class="option px-4 py-3 hover:bg-gray-100">
            <a href="{{ route('profile') }}" class="flex items-center gap-3 text-gray-800 text-sm ">
                <i class='bx bx-user'></i> <span>Manage My Account</span>
            </a>
        </div>
        <div class="option px-4 py-3 hover:bg-gray-100">
            <a href="{{ route('order.list') }}" class="flex items-center gap-3 text-gray-800 text-sm">
                <i class='bx bxl-shopify'></i> <span>My Order</span>
            </a>
        </div>
        <div class="option px-4 py-3 hover:bg-gray-100">
            <a href="{{ route('logout') }}" class="flex items-center gap-3 text-red-800 text-sm">
                <i class='bx bx-log-out'></i> <span>Logout</span>
            </a>
        </div>
    </div>
</header>

<script>
    // Toggle akun dropdown
    function toggleDropdown() {
        const dropdown = document.getElementById("accountDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Tutup dropdown akun kalau klik di luar
    window.addEventListener("click", function (e) {
        const dropdown = document.getElementById("accountDropdown");
        const profileIcons = document.querySelectorAll(".bx-user");

        let isUserIcon = false;
        profileIcons.forEach(icon => {
            if (icon.contains(e.target)) isUserIcon = true;
        });

        if (!dropdown.contains(e.target) && !isUserIcon) {
            dropdown.classList.add("hidden");
        }
    });

    // Toggle mobile menu
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById("mobileMenu");
        mobileMenu.classList.toggle("hidden");
    }

    // Dropdown kategori dengan delay agar tidak hilang saat pindah cursor
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('categoryDropdownContainer');
        const dropdown = document.getElementById('categoryDropdown');
        const button = document.getElementById('categoryDropdownBtn');

        let timeoutId;

        function showDropdown() {
            clearTimeout(timeoutId);
            dropdown.classList.remove('opacity-0', 'invisible');
            dropdown.classList.add('opacity-100', 'visible');
            button.setAttribute('aria-expanded', 'true');
        }

        function hideDropdown() {
            timeoutId = setTimeout(() => {
                dropdown.classList.add('opacity-0', 'invisible');
                dropdown.classList.remove('opacity-100', 'visible');
                button.setAttribute('aria-expanded', 'false');
            }, 150); // delay supaya tidak langsung hilang
        }

        container.addEventListener('mouseenter', showDropdown);
        container.addEventListener('mouseleave', hideDropdown);

        button.addEventListener('focus', showDropdown);
        button.addEventListener('blur', () => {
            setTimeout(() => {
                if (!dropdown.contains(document.activeElement)) {
                    hideDropdown();
                }
            }, 100);
        });

        dropdown.addEventListener('focusin', showDropdown);
        dropdown.addEventListener('focusout', () => {
            setTimeout(() => {
                if (document.activeElement !== button && !dropdown.contains(document.activeElement)) {
                    hideDropdown();
                }
            }, 100);
        });
    });
</script>