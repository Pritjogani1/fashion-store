<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="text-center mb-8">
                <div class="text-green-500 text-6xl mb-4">✓</div>
                <h1 class="text-3xl font-bold text-gray-800">Order Placed Successfully!</h1>
                <p class="text-gray-600 mt-2">Order #{{ $order->id }}</p>
            </div>

            <!-- Order Summary -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Order Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Shipping Details -->
                    <div class="border rounded-lg p-4">
                        <h3 class="font-semibold mb-2">Shipping Details</h3>
                        <p>{{ $order->address->full_name }}</p>
                        <p>{{ $order->address->address_line }}</p>
                        <p>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->pincode }}</p>
                        <p>{{ $order->address->country }}</p>
                        <p>Phone: {{ $order->address->phone }}</p>
                    </div>

                    <!-- Order Info -->
                    <div class="border rounded-lg p-4">
                        <h3 class="font-semibold mb-2">Order Information</h3>
                        <p>Order Date: {{ $order->created_at->format('d M, Y') }}</p>
                        <p>Status: <span class="capitalize">{{ $order->status }}</span></p>
                        <p>Total Amount: ₹{{ $order->total }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items Preview -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center border-b pb-4">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded">
                            <div class="ml-4 flex-1">
                                <h4 class="font-medium">{{ $item->product_name }}</h4>
                                <p class="text-gray-600">Quantity: {{ $item->quantity }}</p>
                                <p class="text-gray-600">₹{{ $item->price }} each</p>
                            </div>
                            <p class="font-medium">₹{{ $item->price * $item->quantity }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-center gap-4">
                <button onclick="window.print()" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300">
                    🖨️ Print Order
                </button>
                <a href="/" class="bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .container { padding: 0; }
            button { display: none; }
            a { display: none; }
            .shadow-lg { box-shadow: none; }
        }
    </style>
</x-layout>