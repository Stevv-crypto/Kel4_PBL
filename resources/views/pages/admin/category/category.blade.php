@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Manage Categories</h1>
                    <p class="text-gray-600">Manage your product and service categories</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="showAddCategoryForm()" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Category
                    </button>
                </div>
            </div>
        </div>

        {{-- Add Category Modal --}}
        <div id="addCategoryForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-200 rounded-t-2xl bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h2 class="text-xl font-bold text-gray-900">Add New Category</h2>
                    <p class="text-sm text-gray-600 mt-1">Create a new category to organize your products</p>
                </div>

                <form action="{{ route('category.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">Category Code</label>
                            <input type="text" id="code" name="code" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all duration-200">
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Category Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all duration-200">
                        </div>

                        <div class="flex items-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="ON" 
                                    class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <span class="ml-3 text-sm font-medium text-gray-700">Active Status</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex space-x-3 mt-8">
                        <button type="button" onclick="hideAddCategoryForm()" 
                            class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-medium hover:from-blue-700 hover:to-blue-800 shadow-lg hover:shadow-xl transition-all duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Category Modal --}}
        <div id="editCategoryForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-200 rounded-t-2xl bg-gradient-to-r from-amber-50 to-orange-50">
                    <h2 class="text-xl font-bold text-gray-900">Edit Category</h2>
                    <p class="text-sm text-gray-600 mt-1">Update category details</p>
                </div>

                <form id="editForm" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label for="edit_code" class="block text-sm font-semibold text-gray-700 mb-2">Category Code</label>
                            <input type="text" id="edit_code" name="code" readonly
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-500 cursor-not-allowed">
                        </div>

                        <div>
                            <label for="edit_name" class="block text-sm font-semibold text-gray-700 mb-2">Category Name</label>
                            <input type="text" id="edit_name" name="name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all duration-200">
                        </div>

                        <div class="flex items-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="edit_status" name="status" value="ON" 
                                    class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <span class="ml-3 text-sm font-medium text-gray-700">Active Status</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex space-x-3 mt-8">
                        <button type="button" onclick="hideEditCategoryForm()" 
                            class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl font-medium hover:from-amber-600 hover:to-orange-700 shadow-lg hover:shadow-xl transition-all duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Category Table --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Category List</h3>
                <p class="text-sm text-gray-600 mt-1">Total available categories</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Category Name</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-900 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-900 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <span class="text-blue-600 font-bold text-sm">{{ substr($category['code'], 0, 2) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $category['code'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $category['name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('category.updateStatus', $category['code']) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                            class="px-3 py-1 rounded-full text-xs font-medium border-0 focus:ring-2 focus:ring-offset-2 {{ $category['status'] == 'ON' ? 'bg-green-100 text-green-800 focus:ring-green-500' : 'bg-red-100 text-red-800 focus:ring-red-500' }}">
                                            <option value="ON" {{ $category['status'] == 'ON' ? 'selected' : '' }}>ACTIVE</option>
                                            <option value="OFF" {{ $category['status'] == 'OFF' ? 'selected' : '' }}>INACTIVE</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-3">
                                    <button onclick="showEditCategoryForm(
                                           '{{ $category['code'] }}',
                                           `{{ addslashes($category['name']) }}`,
                                           '{{ $category['status'] }}',
                                           '{{ route('category.update', $category['code']) }}'
                                       )"
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('category.destroy', $category['code']) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200"
                                            title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No categories yet</h3>
                                        <p class="text-gray-500 mb-4">Start by adding your first category</p>
                                        <button onclick="showAddCategoryForm()" 
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Add Category
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Modal JavaScript --}}
<script>
    function showAddCategoryForm() {
        const modal = document.getElementById('addCategoryForm');
        modal.classList.remove('hidden');
        // Add animation
        setTimeout(() => {
            modal.querySelector('.bg-white').classList.add('animate-pulse');
        }, 10);
    }

    function hideAddCategoryForm() {
        const modal = document.getElementById('addCategoryForm');
        modal.classList.add('hidden');
        // Reset form
        modal.querySelector('form').reset();
    }

    function showEditCategoryForm(code, name, status, url) {
        const modal = document.getElementById('editCategoryForm');
        modal.classList.remove('hidden');

        document.getElementById('edit_code').value = code || '';
        document.getElementById('edit_name').value = name || '';
        document.getElementById('edit_status').checked = (status === 'ON');

        document.getElementById('editForm').action = url;
        
        // Add animation
        setTimeout(() => {
            modal.querySelector('.bg-white').classList.add('animate-pulse');
        }, 10);
    }

    function hideEditCategoryForm() {
        const modal = document.getElementById('editCategoryForm');
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const addModal = document.getElementById('addCategoryForm');
        const editModal = document.getElementById('editCategoryForm');
        
        if (event.target === addModal) {
            hideAddCategoryForm();
        }
        if (event.target === editModal) {
            hideEditCategoryForm();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            hideAddCategoryForm();
            hideEditCategoryForm();
        }
    });
</script>
@endsection