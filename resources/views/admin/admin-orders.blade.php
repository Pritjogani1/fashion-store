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
                        <th class="p-3 border">Status</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="p-3 border">#1023</td>
                        <td class="p-3 border">Rahul Sharma</td>
                        <td class="p-3 border">₹2,500</td>
                        <td class="p-3 border text-green-600">Completed</td>
                        <td class="p-3 border text-blue-600 cursor-pointer">View | Cancel</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 border">#1024</td>
                        <td class="p-3 border">Sneha Patel</td>
                        <td class="p-3 border">₹3,200</td>
                        <td class="p-3 border text-yellow-600">Pending</td>
                        <td class="p-3 border text-blue-600 cursor-pointer">View | Cancel</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 border">#1025</td>
                        <td class="p-3 border">Amit Verma</td>
                        <td class="p-3 border">₹1,800</td>
                        <td class="p-3 border text-red-600">Cancelled</td>
                        <td class="p-3 border text-blue-600 cursor-pointer">View | Reorder</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    
</x-adminlayout>