<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6">{{ $category->name }}</h2>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-600">₹{{ $product->price }}</p>
                        <button class="mt-4 w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800">
                            Add to Cart
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">No products found in this category.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-layout>