<x-layout>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Main Product Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 bg-white rounded-xl shadow-lg p-8">
            <!-- Product Image -->
            <div class="w-full relative">
                <div class="aspect-square overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transform hover:scale-105 transition duration-300">
                </div>
                <div class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-md">
                    <!-- Add favorite icon or other actions here -->
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-6 py-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                <p class="text-2xl font-semibold text-gray-900">₹{{ $product->price }}</p>
                <div class="border-t border-gray-200 pt-4">
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Add to Cart Button -->
                <button class="mt-6 w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition duration-300 add-to-cart" 
                        data-id="{{ $product->id }}">
                    Add to Cart
                </button>

                <!-- Additional Product Info -->
                <div class="grid grid-cols-2 gap-4 mt-6 border-t border-gray-200 pt-6">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">In Stock</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-600">Fast Delivery</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Products Section -->
        @if($similarProducts->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">You Might Also Like</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($similarProducts as $similarProduct)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                            <a href="{{ route('product.preview', $similarProduct) }}" class="block">
                                <div class="aspect-square overflow-hidden">
                                    <img src="{{ asset('storage/' . $similarProduct->image)}}" 
                                         alt="{{ $similarProduct->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $similarProduct->name }}</h3>
                                    <p class="text-gray-600 mt-2">₹{{ $similarProduct->price }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout>