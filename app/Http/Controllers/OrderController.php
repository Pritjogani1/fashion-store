<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    
    }

    public function checkout()
    {
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty');
        }
        return view('store.checkout');
    }

    public function storeAddress(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'full_name' => 'required',
            'address_line' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ]);
       

   $address =   $this->orderService->storeAddress($validatedData);
   
        return redirect()->route('order.confirm');
    }

    public function confirmOrder()
    {
        
        if (!session()->has('checkout_address')) {
        
            return redirect()->route('checkout')->with('error', 'Please provide shipping address');
        }
        
        $data = $this->orderService->getCheckoutData();
        return view('store.confirm-order', ['data' => $data]);
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
        $order = Order::with('items')->findOrFail($orderId);
        return view('store.order-success', compact('order'));
    }
}
