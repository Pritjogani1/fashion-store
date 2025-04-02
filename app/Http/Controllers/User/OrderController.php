<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderAddressRequest;
use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\OrderPlaced;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout()
    {
        try{
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty');
        }
        return view('store.checkout');
    }
    catch(\Exception $e) {
        return back()->withErrors([
           'message' => 'An error occurred while fetching the user.',
        ]);
    }
}

    public function storeAddress(OrderAddressRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $address = $this->orderService->storeAddress($validatedData);
            return redirect()->route('order.confirm');
        } catch(\Exception $e) {
            return back()->withErrors([
                'message' => 'An error occurred while storing the address.',
            ]);
        }
    }

    public function confirmOrder()
    {
        
        try{
        if (!session()->has('checkout_address')) {
        
            return redirect()->route('checkout')->with('error', 'Please provide shipping address');
        }
        
        $data = $this->orderService->getCheckoutData();
        return view('store.confirm-order', ['data' => $data]);
    }
    catch(\Exception $e) {
        return back()->withErrors([
          'message' => 'An error occurred while fetching the user.',
        ]);
    }

}


    public function placeOrder()
    {
        
        try {
            
            if (!session()->has('cart') || empty(session('cart'))) {
               
                return redirect()->route('cart.show')->with('error', 'Your cart is empty');
              
            }

            if (!session()->has('checkout_address')) {
               
                return redirect()->route('checkout')->with('error', 'Please provide shipping address');
               
            }

            $order = $this->orderService->createOrder();
           
            session()->forget(['cart', 'checkout_address']);
            
            return redirect()->route('order.success', $order->id)
                           ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
          
            return redirect()->back()
                           ->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function orderSuccess($orderId)
    {
        try{
        $order = Order::with('items')->findOrFail($orderId);
        event(new OrderPlaced($order));
        return view('store.order-success', compact('order'));
        }
        catch(\Exception $e) {
            return back()->withErrors([
               'message' => 'An error occurred while fetching the user.',
            ]);
        }
    }
}
