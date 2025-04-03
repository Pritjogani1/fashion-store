<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">Shipping Address</h2>
        
        <div class="max-w-2xl mx-auto">
            <!-- Default Address Form -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Select Default Address</h3>
                <form action="{{ route('order.storeAddress') }}" method="POST">
                    @csrf
                    @foreach($addresses as $address)
                    <div class="flex items-center mb-4 p-4 border rounded-lg hover:bg-gray-50 transition-colors">
                        <input type="radio" name="address_id" 
                               value="{{ $address->id }}" 
                               class="form-radio h-5 w-5 text-blue-600"
                               {{ $address->is_default ? 'checked' : '' }}>
                        <label class="ml-3 text-gray-700">
                            <p>{{ $address->full_name }}</p>
                            <p>{{ $address->address_line }}</p>
                            <p class="font-medium">{{ $address->street }}, {{ $address->city }}</p>
                            <p class="text-sm">{{ $address->state }} - {{ $address->zip }}</p>
                            <p class="text-sm">{{ $address->country }}</p>
                            @if($address->is_default)
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Default</span>
                            @endif
                        </label>
                    </div>
                    @endforeach
                    
                    <div class="text-right">
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Use Selected Address
                        </button>
                    </div>
                </form>
            </div>

            <!-- New Address Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Add New Shipping Address</h3>
                <form action="{{ route('order.storeAddress') }}" method="POST" >
                    @csrf
               
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <input type="text" name="full_name" placeholder="Full Name" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <input type="text" name="address_line" placeholder="Street Address" required
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <input type="text" name="city" placeholder="City" required
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="state" placeholder="State" required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <input type="text" name="pincode" placeholder="ZIP Code" required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <input type="text" name="country" placeholder="Country" required
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                   <input type="text" name="phone" placeholder="Phone" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        
                        <label class="flex items-center space-x-2">
                            <input type="hidden" name="set_default" value="0">
                            <input type="checkbox" name="set_default" value="1"
                                   class="form-checkbox h-5 w-5 text-blue-600"
                                   onchange="this.previousElementSibling.value = this.checked ? '1' : '0'">
                            <span class="text-gray-700">Set as default address</span>
                        </label>
                    </div>

                    <div class="text-right mt-6">
                        <button type="submit" 
                                class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                            Add New Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>