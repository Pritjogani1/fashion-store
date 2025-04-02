<!-- For each cart item -->
@foreach($cartItems as $item)
    <div class="flex items-center justify-between">
        <!-- ... existing cart item content ... -->
        
        <a href="{{ route('products.preview', $item->product) }}" 
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            View Details
        </a>
    </div>
@endforeach