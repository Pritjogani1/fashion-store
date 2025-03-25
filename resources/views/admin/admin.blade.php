<x-adminlayout>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Orders</h3>
                    <p class="text-2xl font-semibold">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Revenue</h3>
                    <p class="text-2xl font-semibold">₹{{ number_format($totalRevenue) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Categories</h3>
                    <p class="text-2xl font-semibold">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Products</h3>
                    <p class="text-2xl font-semibold">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing Orders Table -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Recent Orders</h2>
            <a href="{{ route('admin.orders') }}" class="text-blue-500 hover:text-blue-600">View All Orders</a>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-6 py-3">Order ID</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">#{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->user->name }}</td>
                            <td class="px-6 py-4">₹{{ $order->total }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('d M, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-sm
                                    @if($order->status === 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.orders.details', $order->id) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View Details
                                    </a>
                                
                                    <button onclick="openStatusModal({{ $order['id'] }}, '{{ $order['status'] }}')"
                                            class="inline-flex items-center px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                        Update Status
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No recent orders found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Status Update Modal -->
    <!-- Update the modal div -->
    <div id="statusModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-96 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <h3 class="text-lg font-semibold mb-4">Update Order Status</h3>
            <form id="statusForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Select Status</label>
                    <select id="statusSelect" class="w-full border rounded px-3 py-2">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="delivered">deliverd</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeStatusModal()" 
                            class="px-4 py-2 border rounded hover:bg-gray-100">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
      
    </div>

    <!-- Update the JavaScript -->
    <script>
        let currentOrderId = null;
    
        function openStatusModal(orderId, currentStatus) {
            currentOrderId = orderId;
            document.getElementById('statusSelect').value = currentStatus;
            const modal = document.getElementById('statusModal');
            const modalContent = document.getElementById('modalContent');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Add animation delay
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50);
        }
    
        function closeStatusModal() {
            const modal = document.getElementById('statusModal');
            const modalContent = document.getElementById('modalContent');
            
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const status = document.getElementById('statusSelect').value;
            
            fetch(`/admin/orders/${currentOrderId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Update failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update status. Please try again.');
            });
        });
    </script>
</x-adminlayout>
