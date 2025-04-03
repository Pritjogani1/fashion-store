<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\create_shipping_address;
use App\Models\useraddress;
use PhpParser\Builder\UseTest;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;

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
     
        
  if(empty($address['address_id'])) {
    
    if( $address['set_default'] === "1"){
        // Create a new address for the user and associate it with the order
        $address = useraddress::create([
            'user_id' => $user->id,
            'full_name' => $address['full_name'],
            'address_line' => $address['address_line'],
            'city' => $address['city'],
            'state' => $address['state'],
            'pincode' => $address['pincode'],
            'phone' => $address['phone'],
            'country' => $address['country'],
            'type' => 'shipping',
        ]);
        $data = $address->toArray();
        unset($data['id']);

    }
    
        $addresses = Address::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'full_name' => $address['full_name'],
            'address_line' => $address['address_line'],
            'city' => $address['city'],
            'state' => $address['state'],
            'pincode' => $address['pincode'],
            'phone' => $address['phone'],
            'country' => $address['country'],
            'type' =>'shipping',

        ]);
        $data = $addresses->toArray();
        unset($data['id']);   
    }
      else
      {
        
            $address = useraddress::find($address['address_id']);
            $addresses = Address::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'full_name' => $address['full_name'],
                'address_line' => $address['address_line'],
                'city' => $address['city'],
                'state' => $address['state'],
                'pincode' => $address['pincode'],
                'phone' => $address['phone'],
                'country' => $address['country'],
                'type' =>'shipping',

            ]);
            
            $data = $addresses->toArray();
            unset($data['id']);
      }
      

       

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