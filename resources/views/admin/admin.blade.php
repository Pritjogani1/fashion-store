<x-adminlayout>
 
        
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h2 class="text-3xl font-semibold mb-6">Welcome to the Admin Dashboard</h2>
            <div class="grid grid-cols-3 gap-6">
                <div class="p-6 bg-white rounded-lg shadow-md text-center">
                    <h3 class="text-xl font-semibold">Total Products</h3>
                    <p class="text-3xl mt-2 text-gray-700">120</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md text-center">
                    <h3 class="text-xl font-semibold">Orders Today</h3>
                    <p class="text-3xl mt-2 text-gray-700">35</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md text-center">
                    <h3 class="text-xl font-semibold">Total Revenue</h3>
                    <p class="text-3xl mt-2 text-gray-700">₹75,000</p>
                </div>
            </div>
            <div class="mt-10">
                <h3 class="text-2xl font-semibold mb-4">Recent Orders</h3>
                <table class="w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 text-left">Order ID</th>
                            <th class="p-3 text-left">Customer</th>
                            <th class="p-3 text-left">Amount</th>
                            <th class="p-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="p-3">#1023</td>
                            <td class="p-3">Rahul Sharma</td>
                            <td class="p-3">₹2,500</td>
                            <td class="p-3 text-green-600">Completed</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3">#1024</td>
                            <td class="p-3">Sneha Patel</td>
                            <td class="p-3">₹3,200</td>
                            <td class="p-3 text-yellow-600">Pending</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3">#1025</td>
                            <td class="p-3">Amit Verma</td>
                            <td class="p-3">₹1,800</td>
                            <td class="p-3 text-red-600">Cancelled</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
       
</x-adminlayout>
