<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class OrderService
{
    public function storeAddress($data)
    {
        Session::put('checkout_address', $data);
        return $data;
    }

    public function getCheckoutData()
    {
        return [
            'cart' => Session::get('cart', []),
            'cartTotal' => $this->calculateCartTotal(Session::get('cart', [])),
            'address_line' => Session::get('checkout_address', [])
        ];
    }

    public function createOrder()
    {
       
        $cart = Session::get('cart', []);
        $address = Session::get('checkout_address');
        $user = Auth::user();
       
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $this->calculateCartTotal($cart),
            'status' => 'pending',
        ]);
       
    
        $address = Address::create([
            'user_id' => $user->id,
            'full_name' => $address['full_name'],
            'address_line' => $address['address_line'],
            'city' => $address['city'],
            'state' => $address['state'],
            'pincode' => $address['pincode'],
            'phone' => $address['phone'],
            'country' => $address['country'],
            'type' => 'shipping'
        ]);
      
       

        foreach ($cart as $item) {
           $orderitem =  OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image']
            ]);
          
        }

        return $order;
    }

    private function calculateCartTotal($cart)
    {
        return array_reduce($cart, function($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }
}