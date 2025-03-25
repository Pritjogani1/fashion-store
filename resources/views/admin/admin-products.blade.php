
<x-adminlayout>
    <main class="flex-1 p-6 bg-gray-50">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Products</h2>
                <p class="text-gray-600 mt-1">Manage your product inventory</p>
            </div>
            <a href="/admin/addproducts" class="inline-flex items-center px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors duration-200 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Product
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Image</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Description</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Categories</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-600">#{{$product->id}}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{$product->name}}</td>
                                <td class="px-6 py-4 text-gray-600">₹{{number_format($product->price, 2)}}</td>
                                <td class="px-6 py-4">
                                    <img src="{{asset('/storage/'. $product->image)}}" 
                                         alt="{{$product->name}}" 
                                         class="w-20 h-20 object-cover rounded-lg shadow">
                                </td>
                                <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{$product->description}}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($product->categories as $category)
                                            <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="/admin/editproduct/{{$product->id}}" 
                                           class="inline-flex items-center px-3 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        
                                        <button data-modal-target="deleteModal{{$product->id}}" 
                                                data-modal-toggle="deleteModal{{$product->id}}" 
                                                class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div id="deleteModal{{$product->id}}" tabindex="-1" 
                                         class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-lg">
                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" 
                                                        data-modal-hide="deleteModal{{$product->id}}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this product?</h3>
                                                    <form action="/admin/products/{{$product->id}}" method="POST" class="inline-flex justify-center gap-3">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                                                            Yes, delete it
                                                        </button>
                                                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5" 
                                                                data-modal-hide="deleteModal{{$product->id}}">
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
        </div>
    </main>
</x-adminlayout>