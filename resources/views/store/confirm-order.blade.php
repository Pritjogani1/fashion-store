<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-8">Confirm Order</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-4">Shipping Address</h3>
                    <div class="text-gray-600">
{{--                 
                        <p class="font-medium">{{$data['address_line']['full_name'] }}</p>
                        <p>{{ $data['address_line']['address_line'] }}</p>
                        <p>{{ $data['address_line']['city'] }}, {{ $data['address_line']['state'] }}
                            {{ $data['address_line']['country'] }}
                        </p>
                        <p>PIN: {{ $data['address_line']['pincode'] }}</p>
                        <p>Phone: {{ $data['address_line']['phone'] }}</p> --}}
                        <div>
                     
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Order Items</h3>
                    @foreach($data['cart'] as $item)
                        <div class="flex items-center py-4 border-b">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover rounded">
                            <div class="ml-4 flex-1">
                                <h4 class="font-medium">{{ $item['name'] }}</h4>
                                <p class="text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                <p class="text-gray-600">₹{{ $item['price'] }}</p>
                            </div>
                            <p class="font-medium">₹{{ $item['price'] * $item['quantity'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                    <div class="flex justify-between mb-2">
                        <span>Items Total</span>
                       
                        <span>₹{{ $data['cartTotal'] }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between mb-4 text-xl font-semibold">
                        <span>Total</span>
                        
                        <span>₹{{ $data['cartTotal'] }}</span>
                    {{-- </div> --}}
                    <form action="{{ route('order.place') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-black text-white py-3 rounded-xl hover:bg-gray-800">
                            Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>