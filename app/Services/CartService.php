<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function addToCart(Product $product)
    {
        $cart = $this->getCart();
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'id' => $product->id
            ];
        }

        Session::put('cart', $cart);
        return [
            'cart' => $cart,
            'cartTotal' => $this->calculateCartTotal($cart)
        ];
    }

    public function updateCart($productId, $quantity)
    {
        $cart = $this->getCart();
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
            return [
                'cart' => $cart,
                'cartTotal' => $this->calculateCartTotal($cart),
                'totalItems' => $this->getTotalItems($cart),
              
            ];
        }
        
        return false;
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return [
                'cart' => $cart,
                'cartTotal' => $this->calculateCartTotal($cart),
               
            ];
        }
        
        return false;
    }

    public function getCartDetails()
    {
        $cart = $this->getCart();
        return [
            'cart' => $cart,
            'cartTotal' => $this->calculateCartTotal($cart),
            'totalItems' => $this->getTotalItems($cart),
          
        ];
    }

    public function clearCart()
    {
        Session::forget('cart');
        return [
            'cart' => [],
            'cartTotal' => 0
        ];
    }

    private function getCart()
    {
        return Session::get('cart', []);
    }

    private function calculateCartTotal($cart)
    {
        return array_reduce($cart, function($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }


    private function getTotalItems($cart)
    {
        return array_reduce($cart, function($total, $item) {
            return $total + $item['quantity'];
        }, 0);
    }
}