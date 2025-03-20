<x-adminlayout>
    <main class="flex-1 p-6">
        <h2 class="text-3xl font-semibold mb-6">Edit Product</h2>
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