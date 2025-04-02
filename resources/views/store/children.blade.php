<x-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Categories Filter -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Categories</h2>
            <div class="flex gap-4">
                <a href="{{ route('children') }}" 
                   class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('children', $category->name) }}" 
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
           
                <!-- Product Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-600">₹{{ $product->price }}</p>
                        <button class="mt-4 w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 add-to-cart" 
                                data-id="{{ $product->id }}">
                            Add to Cart
                        </button>
                        <a href="{{ route('product.preview', $product->slug) }}" 
                           class="mt-2 w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</x-layout>