<!-- resources/views/includes/sidebar.blade.php -->
<aside class="space-y-2 hidden md:block">
    <ul class="bg-[#b0cee3] shadow p-4 space-y-2">
        <li><a href="{{ route('tampilKategori', 'air-conditioner') }}" class="block hover:text-blue-700">Air Conditioner</a></li>
        <li><a href="{{ route('tampilKategori', 'dispensers') }}" class="block hover:text-blue-700">Dispensers</a></li>
        <li><a href="{{ route('tampilKategori', 'television') }}" class="block hover:text-blue-700">Television</a></li>
        <li><a href="{{ route('tampilKategori', 'refrigerator') }}" class="block hover:text-blue-700">Refrigerator</a></li>
        <li><a href="{{ route('tampilKategori', 'washing-machine') }}" class="block hover:text-blue-700">Washing Machine</a></li>
        <li><a href="{{ route('tampilKategori', 'fan') }}" class="block hover:text-blue-700">Fan</a></li>
        <li><a href="{{ route('tampilKategori', 'rice-cooker') }}" class="block hover:text-blue-700">Rice Cooker</a></li>
    </ul>
</aside>