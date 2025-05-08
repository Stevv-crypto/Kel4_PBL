<!-- Mobile Toggle Button (Top Left, No Title) -->
<div class="md:hidden fixed top-4 left-4 z-50">
    <button id="menuToggle" class="text-gray-800 bg-[#b0cee3] p-2 rounded shadow-md focus:outline-none">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>

<!-- Mobile Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed z-40 inset-y-0 left-0 w-64 bg-[#b0cee3] shadow-md p-4 transform -translate-x-full md:translate-x-0 md:relative md:inset-0 transition-transform duration-300 ease-in-out space-y-4">
    <div class="hidden md:flex items-center mb-6">
        <h1 class="font-bold text-lg ml-2 md:ml-6">E-TechnoCart</h1>
    </div>

    <nav>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('dashboard') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('product*') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-box mr-3"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('inbox') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('inbox') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-inbox mr-3"></i> Inbox
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('order') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-list mr-3"></i> Order Lists
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('manage_product') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-cubes mr-3"></i> Manage Products
                </a>
            </li>
        </ul>

        <div class="mt-8">
            <h3 class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-2 ml-2">Management</h3>
            <ul class="space-y-2">
                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-lg {{ request()->routeIs('sales_report') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                        <i class="fas fa-chart-line mr-3"></i> Sales Report
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-lg {{ request()->routeIs('team') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                        <i class="fas fa-users mr-3"></i> Team
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-lg {{ request()->routeIs('setting') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                        <i class="fas fa-cog mr-3"></i> Settings
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-[#4880FF]">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>

<!-- Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleBtn = document.getElementById('menuToggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
