<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request, $product)
    {
        $productModel = Product::findOrFail($product);
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productModel->id])) {
            $cart[$productModel->id]['quantity'] += 1;
        } else {
            $cart[$productModel->id] = [
                'name' => $productModel->name,
                'price' => $productModel->price,
                'quantity' => 1,
                'image' => $productModel->image,
                'id' => $productModel->id
            ];
        }

        session()->put('cart', $cart);
        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart' => $cart,
            'cartTotal' => $this->calculateCartTotal($cart)
        ]);
    }

    public function updateCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $cart = session()->get('cart', []);
        $productId = $request->id;
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json([
                'message' => 'Cart updated successfully!',
                'cart' => $cart,
                'cartTotal' => $this->calculateCartTotal($cart),
                'totalItems' => array_reduce($cart, function($total, $item) {
                    return $total + $item['quantity'];
                }, 0)
            ]);
        }

        return response()->json(['error' => 'Product not found in cart'], 404);
    }

    public function removeFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $cart = session()->get('cart', []);
        $productId = $request->id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return response()->json([
                'message' => 'Product removed from cart successfully!',
                'cart' => $cart,
                'cartTotal' => $this->calculateCartTotal($cart)
            ]);
        }

        return response()->json(['error' => 'Product not found in cart'], 404);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);
        $totalItems = array_reduce($cart, function($total, $item) {
            return $total + $item['quantity'];
        }, 0);
        return view('store.cart', compact('cart', 'cartTotal', 'totalItems'));
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json([
            'message' => 'Cart cleared successfully!',
            'cart' => [],
            'cartTotal' => 0
        ]);
    }

    private function calculateCartTotal($cart)
    {
        return array_reduce($cart, function($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }
}