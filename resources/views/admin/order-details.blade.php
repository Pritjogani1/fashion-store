<x-adminlayout>
    <main class="flex-1 p-6">
        <div class="mb-4">
            <a href="{{ route('admin.orders') }}" class="text-blue-600 hover:text-blue-800">← Back to Orders</a>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Order #{{ $order->id }}</h2>
                <span class="px-3 py-1 rounded-full 
                    @if($order->status === 'completed') bg-green-100 text-green-800
                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Customer Information -->
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-3">Customer Information</h3>
                    <p><strong>Name:</strong> {{ $order->full_name }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                </div>

                <!-- Shipping Address -->
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-3">Shipping Address</h3>
                    <p>{{ $order->address_line }}</p>
                    <p>{{ $order->city }}, {{ $order->state }} {{ $order->pincode }}</p>
                    <p>{{ $order->country }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-6">
                <h3 class="font-semibold mb-4">Order Items</h3>
                <div class="border rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Product</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="px-4 py-2 text-left">Quantity</th>
                                <th class="px-4 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/' . $item->image) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="w-12 h-12 object-cover rounded mr-3">
                                            <span>{{ $item->product_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">₹{{ $item->price }}</td>
                                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3">₹{{ $item->price * $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right font-semibold">Total Amount:</td>
                                <td class="px-4 py-3 font-semibold">₹{{ $order->total_amount }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Order Timeline -->
            <div>
                <h3 class="font-semibold mb-4">Order Timeline</h3>
                <div class="border rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <div class="ml-3">
                            <p class="font-medium">Order Placed</p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M, Y H:i') }}</p>
                        </div>
                    </div>
                    @if($order->status !== 'pending')
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <div class="ml-3">
                                <p class="font-medium">Status Updated to {{ ucfirst($order->status) }}</p>
                                <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M, Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-adminlayout>