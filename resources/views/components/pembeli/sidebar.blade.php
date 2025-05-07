<!-- resources/views/includes/sidebar.blade.php -->
<aside class="space-y-2 hidden md:block">
    <ul class="bg-[#b0cee3] shadow p-4 space-y-2">
        @foreach (\App\Models\Product::all()->pluck('category')->unique() as $category)
            <li>
                <a href="{{ route('category', strtolower($category)) }}" class="block hover:text-blue-700">
                    {{ ucfirst($category) }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>
