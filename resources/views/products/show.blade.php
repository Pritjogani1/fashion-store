<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="w-full">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                <p class="text-2xl font-semibold">₹{{ $product->price }}</p>
                <p class="text-gray-600">{{ $product->description }}</p>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-black text-white rounded-full">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>

        <!-- Similar Products -->
        @if($similarProducts->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Similar Products</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($similarProducts as $similarProduct)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <a href="{{ route('products.show', $similarProduct) }}" >
                                <img src="{{ asset('storage/' . $similarProduct->image) }}" alt="{{ $similarProduct->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg">{{ $similarProduct->name }}</h3>
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