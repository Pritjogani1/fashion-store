<x-adminlayout>
    <main class="flex-1 p-6">

        <div class=" ">
            <h1 class="text-3xl font-semibold ">Edit Product</h1>
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.products') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Products
                </a>
            </div>
        </div>
       

        <div class="bg-white p-6 rounded-lg shadow-md">
         
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Product Name</label>
                    <input type="text" class="w-full p-3 border rounded-lg" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Slug</label>
                    <input type="text" class="w-full p-3 border rounded-lg bg-gray-100" name="slug" value="{{ $product->slug }}" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea class="w-full p-3 border rounded-lg" name="description" rows="3" required>{{ $product->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Price</label>
                    <input type="number" class="w-full p-3 border rounded-lg" name="price" value="{{ $product->price }}" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Categories</label>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="categories[]" 
                                       value="{{ $category->id }}" 
                                       class="rounded border-gray-300"
                                       id="category_{{ $category->id }}"
                                       {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="category_{{ $category->id }}" class="ml-2">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Product Image</label>
                    <input type="file" class="w-full p-3 border rounded-lg" name="image">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current product image" class="mt-2 w-32">
                    @endif
                </div>

                <button type="submit" class="w-full bg-black text-white p-3 rounded-lg hover:bg-white hover:text-black">
                    Update Product
                </button>
            </form>
        </div>
    </main>

    <script>
        document.querySelector('input[name="name"]').addEventListener('input', function() {
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.querySelector('input[name="slug"]').value = slug;
        });
    </script>
</x-adminlayout>