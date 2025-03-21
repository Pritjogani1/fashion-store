<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-8">Shipping Address</h2>
        
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('checkout.address') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-gray-700">Full Name</label>
                        <input type="text" name="full_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700">Address</label>
                        <textarea name="address_line" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">City</label>
                            <input type="text" name="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700">State</label>
                            <input type="text" name="state" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Pincode</label>
                            <input type="text" name="pincode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700">Phone</label>
                            <input type="text" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Country</label>
                            <input type="text" name="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="w-full bg-black text-white py-3 rounded-xl hover:bg-gray-800">
                        Continue to Order Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>