<x-adminlayout>
    <main class="flex-1 p-6 bg-gray-50">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex justify-between items-center mb-8 border-b pb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
                    <p class="text-gray-500 mt-1">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($order->status === 'completed') bg-green-100 text-green-800
                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Customer Information -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Customer Details</h3>
                    </div>
                    <div class="space-y-3 text-gray-600">
                        <p><span class="font-medium text-gray-700">Name:</span> {{ $order['user']['name'] }}</p>
                        <p><span class="font-medium text-gray-700">Phone:</span> {{ $order['user']['phone'] }}</p>
                        <p><span class="font-medium text-gray-700">Email:</span> {{ $order['user']['email'] }}</p>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Shipping Address</h3>
                    </div>
                    <div class="space-y-2 text-gray-600">
                    
                        <p>{{ $order['address']['address_line'] }}</p>
                        <p>{{ $order['address']['city'] }}, {{ $order->address->state }} {{ $order->address->pincode }}</p>
                        <p>{{ $order->address->country }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800">Order Items</h3>
                </div>
                <div class="bg-gray-50 rounded-xl overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Product</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Quantity</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <tr class="hover:bg-gray-100 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/' . $item->image) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="w-16 h-16 object-cover rounded-lg mr-4">
                                            <span class="font-medium text-gray-700">{{ $item->product_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">₹{{ number_format($item->price, 2) }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-700">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-100">
                                <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-700">Total Amount:</td>
                                <td class="px-6 py-4 font-bold text-gray-800">₹{{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Order Timeline -->
            <div>
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800">Order Timeline</h3>
                </div>
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-700">Order Placed</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                        @if($order->status !== 'pending')
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-700">Status Updated to {{ ucfirst($order->status) }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->updated_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-adminlayout>