<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Search Results for "{{ $keyword }}"</h1>
        
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-2">₹{{ $product->price }}</p>
                            <a href="{{ route('products.show', $product) }}" class="mt-4 inline-block px-4 py-2 bg-black text-white rounded-full">View Product</a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-gray-600">No products found for "{{ $keyword }}"</p>
        @endif

        @if($similarProducts->count() > 0)
            <h2 class="text-2xl font-bold mt-12 mb-6">Similar Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-2">₹{{ $product->price }}</p>
                            <a href="{{ route('products.show', $product) }}" class="mt-4 inline-block px-4 py-2 bg-black text-white rounded-full">View Product</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>