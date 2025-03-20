<x-adminlayout>
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold">Products</h2>
            <a href="/admin/addproducts" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black">Add Product</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Product List</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">Product ID</th>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Price</th>
                        <th class="p-3 border">Image</th>
                        <th class="p-3 border">Description</th>
                        <th class="p-3 border">Categories</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
               @foreach($products as $product)
                    <tr class="border-b">
                        <td class="p-3">{{$product->id}}</td>
                        <td class="p-3">{{$product->name}}</td>
                        <td class="p-3">₹{{$product->price}}</td>
                        <td class="p-3"><img src="{{asset('storage/'.$product->image)}}" alt="" width="100px" height="100px"></td>
                        <td class="p-3">{{$product->description}}</td>
                        <td class="p-3">
                            @foreach($product->categories as $category)
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="p-3 text-center">
                            <a href="/admin/editproduct/{{$product->id}}" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black">Edit</a>
                            <form action="/admin/products/{{$product->id}}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-red-600" onclick="return confirm('Are you sure you want to delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                        @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-adminlayout>