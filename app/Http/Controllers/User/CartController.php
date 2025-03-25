<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request, $product)
    {
        try {
        $productModel = Product::findOrFail($product);
        $result = $this->cartService->addToCart($productModel);
        
        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart' => $result['cart'],
            'cartTotal' => $result['cartTotal'],
           
        ]);
        }
        catch(\Exception $e) {
            return response()->json([
              'success' => false,
              'message' => 'An error occurred while adding the product to the cart.'
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $result = $this->cartService->updateCart($request->id, $request->quantity);
        
        if (!$result) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }

        return response()->json([
            'message' => 'Cart updated successfully!',
            'cart' => $result['cart'],
            'cartTotal' => $result['cartTotal'],
            'totalItems' => $result['totalItems'],
        
        ]);
    }
    catch(\Exception $e) {
        return response()->json([
          'success' => false,
          'message' => 'An error occurred while updating the cart.'
        ]);
    }
}

    public function removeFromCart(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $result = $this->cartService->removeFromCart($request->id);
        
        if (!$result) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }

        return response()->json([
            'message' => 'Product removed from cart successfully!',
            'cart' => $result['cart'],
            'cartTotal' => $result['cartTotal'],
  
        ]);
    }
    catch(\Exception $e) {
        return response()->json([
          'success' => false,
          'message' => 'An error occurred while removing the product from the cart.'
        ]); 
        }
    }

    public function showCart()
    {
        try{
        $result = $this->cartService->getCartDetails();
        return view('store.cart', $result);
    }
    catch(\Exception $e) {
        return response()->json([
         'success' => false,
         'message' => 'An error occurred while fetching the cart details.'
                    ]); 
    }
}

    public function clearCart()
    {
        try{
        $result = $this->cartService->clearCart();
        return response()->json([
            'message' => 'Cart cleared successfully!',
            'cart' => $result['cart'],
            'cartTotal' => $result['cartTotal'],
            
        ]);
    }
    catch(\Exception $e)        
    {
        return response()->json([
           'success' => false,
           'message' => 'An error occurred while clearing the cart.'
                    ]);     
                }
    }
}