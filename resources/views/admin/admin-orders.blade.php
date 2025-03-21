<x-adminlayout>
    <main class="flex-1 p-6">
        <h2 class="text-3xl font-semibold mb-6">Orders</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Order List</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">Order ID</th>
                        <th class="p-3 border">Customer</th>
                        <th class="p-3 border">Total Amount</th>
                        <th class="p-3 border">Date</th>
                        <th class="p-3 border">Status</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 border">#{{ $order['id']}}</td>
                            <td class="p-3 border">{{ $order['user']['name'] }}</td>
                            <td class="p-3 border">₹{{ $order['total'] }}</td>
                            <td class="p-3 border">{{ \Carbon\Carbon::parse($order['created_at'])->format('d M, Y') }}</td>
                            <td class="p-3 border">
                                <span class="px-2 py-1 rounded-full text-sm font-medium
                                    @if($order['status'] === 'delivered') bg-green-100 text-green-800
                                    @elseif($order['status'] === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order['status'] === 'processing') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order['status']) }}
                                </span>
                            </td>
                            <td class="p-3 border">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.orders.details', $order['id']) }}" 
                                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                        View Details
                                    </a>
                                    <button onclick="openStatusModal({{ $order['id'] }}, '{{ $order['status'] }}')"
                                            class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition">
                                        Update Status
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Status Update Modal -->
        <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-xl w-96">
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
    
        <script>
            let currentOrderId = null;
    
            function openStatusModal(orderId, currentStatus) {
                currentOrderId = orderId;
                document.getElementById('statusSelect').value = currentStatus;
                document.getElementById('statusModal').classList.remove('hidden');
                document.getElementById('statusModal').classList.add('flex');
            }
    
            function closeStatusModal() {
                document.getElementById('statusModal').classList.add('hidden');
                document.getElementById('statusModal').classList.remove('flex');
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