<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-4xl font-bold mb-8">🛒 Shopping Cart</h2>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3 space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6 text-right">
                        <span class="text-xl font-semibold">Total Items: <span id="total-items">{{ $totalItems }}</span></span>
                    </div>

                    @forelse($cart as $item)
                    
                        <div class="flex items-center border-b border-gray-200 pb-5">
                            <div class="flex w-2/5 items-center gap-4">
                                <img class="h-24 w-24 rounded-lg object-cover" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                <div>
                                    <p class="font-bold text-lg">{{ $item['name'] }}</p>
                                    <button class="text-red-500 hover:text-red-700 text-sm mt-2" onclick="removeFromCart({{ $item['id'] }})">Remove</button>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5">
                                <button class="text-gray-700 hover:text-black" onclick="updateQuantity({{ $item['id'] }}, 'decrease')">➖</button>
                                <input class="mx-2 border text-center w-12 rounded" type="text" data-id="{{ $item['id'] }}" value="{{ $item['quantity'] }}" readonly>
                                <button class="text-gray-700 hover:text-black" onclick="updateQuantity({{ $item['id'] }}, 'increase')">➕</button>
                            </div>
                            <span class="w-1/5 text-lg font-medium">₹{{ $item['price'] }}</span>
                            <span id="item-total" class="w-1/5 text-lg font-medium item-total">₹{{ $item['price'] * $item['quantity'] }}</span>


                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-xl">🛍️ Your cart is empty</p>
                            <a href="/" class="mt-6 inline-block bg-black text-white px-8 py-3 rounded-lg hover:bg-gray-800">Continue Shopping</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-4">
                    <h2 class="text-2xl font-bold mb-6">Order Summary</h2>
                    <hr class="my-6">
                    <div class="flex justify-between text-xl font-bold">
                        <span>Total</span>
                        <span id="cart-total">₹{{ $cartTotal }}</span>
                        
                    </div>
                    <button onclick="window.location.href='{{ route('checkout') }}'" class="w-full mt-8 bg-black text-white py-3 rounded-xl hover:bg-gray-800 transform transition duration-200 hover:scale-105">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    function showToast(message, color, txt ) {
        Toastify({
                        text: message,
                        duration: 3000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: color
        }).showToast();
    }

    function updateQuantity(productId, action) {
        let quantityInput = document.querySelector(`input[data-id="${productId}"]`);
        let currentQuantity = parseInt(quantityInput.value);
        let newQuantity = action === 'increase' ? currentQuantity + 1 : Math.max(1, currentQuantity - 1);

        if (newQuantity !== currentQuantity) {
            $.post('/cart/update', { id: productId, quantity: newQuantity }, function(response) {
                quantityInput.value = newQuantity;
                updateCartDisplay(response).showToast('Quantity updated successfully ✅','green');
            }).fail(function() {
                showToast('Error updating quantity ❌', 'red');
            });
        }
    }

    function removeFromCart(productId) {
        $.post('/remove-from-cart', { id: productId }, function(response) {
            location.reload();
            showToast('Item removed from cart 🗑️' ,'red');
        }).fail(function() {
            showToast('Error removing item ❌', 'red');
        });
    }

    function updateCartDisplay(response) {
        $('#cart-total').text('₹' + response.cartTotal);

        $('#total-items').text(Object.values(response.cart).reduce((total, item) => total + item.quantity, 0));

        Object.entries(response.cart).forEach(([id, item]) => {
            const itemTotal = item.price * item.quantity;
            
            $(`[data-id="${id}"]`).closest('.flex').find('.item-total').text('₹' + itemTotal);
            return itemTotal;
        });
    }
    </script>
</x-layout>
