<x-adminlayout>
    <main class="flex-1 p-6 bg-gray-50">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Categories</h2>
                <p class="text-gray-600 mt-1">Manage your product categories</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-8">
                @csrf
                <div class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="name" class="w-full p-3 border rounded-lg" placeholder="Category Name" required>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center justify-center min-w-[120px]">
                        <span>Add Category</span>
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Name</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-600">{{ $category->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-3">
                                    <button data-modal-target="editModal{{$category->id}}" 
                                            data-modal-toggle="editModal{{$category->id}}" 
                                            class="inline-flex items-center px-3 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    
                                    <button data-modal-target="deleteModal{{$category->id}}" 
                                            data-modal-toggle="deleteModal{{$category->id}}" 
                                            class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>

                                <!-- Edit Modal -->
                                <div id="editModal{{$category->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="editModal{{$category->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6">
                                                <h3 class="mb-5 text-lg font-semibold text-gray-800">Edit Category</h3>
                                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                                                        <input type="text" name="name" value="{{ $category->name }}" class="w-full p-3 border rounded-lg" required>
                                                    </div>
                                                    <div class="flex justify-end gap-3">
                                                        <button type="button" class="px-4 py-2 text-gray-500 bg-white hover:bg-gray-100 border rounded-lg" data-modal-hide="editModal{{$category->id}}">Cancel</button>
                                                        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Update Category</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div id="deleteModal{{$category->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="deleteModal{{$category->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this category?</h3>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-flex justify-center gap-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                                                        Yes, delete it
                                                    </button>
                                                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5" data-modal-hide="deleteModal{{$category->id}}">
                                                        No, cancel
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Flowbite CSS and JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</x-adminlayout>