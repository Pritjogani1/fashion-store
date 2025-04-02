<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RegisterUserController;
use App\Http\Controllers\User\SessionController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\Homepage;
use App\Http\Controllers\SearchController;


// Public routes
Route::get("/", [Homepage::class, "index"])->name("homepage");
Route::get('/men/{category?}', [Homepage::class, 'men'])->name('men');
Route::get('/products/{category:slug}', [ProductController::class, 'byCategory'])->name('products.category');

// Guest routes
Route::middleware("guest:user")->group(function() {
    Route::get("register", [RegisterUserController::class, "create"])->name("");
    Route::post("register", [RegisterUserController::class, "store"])->name("register");
   Route::get("login", [SessionController::class, "index"])->name("user.login");
    Route::post("login", [SessionController::class, "authenticate"])->name("user.authenticate");
});

// Authenticated routes
Route::middleware("auth:user")->group(function() {
    Route::get("logout", [SessionController::class, "logout"])->name("user.logout");
    Route::get('/about', [Homepage::class, 'about'])->name('about');
    Route::get('/women/{category?}', [Homepage::class, 'women'])->name('women');
    Route::get('/children/{category?}', [Homepage::class, 'children'])->name('children');

    // Cart routes
 Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');
    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');


    
    Route::get('/women/{category?}',[Homepage::class,'women'])->name('women');
    Route::get('/children/{category?}',[Homepage::class,'children'])->name('children');
    
   

    // Checkout and Order routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/address', [OrderController::class, 'storeAddress'])->name('checkout.address');
    Route::get('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/success/{order}', [OrderController::class, 'orderSuccess'])->name('order.success');
});

 //Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/{category:slug}', [ProductController::class, 'byCategory'])
    ->name('products.category');

// Add these routes for product details
// Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product-preview/{product:slug}', [ProductController::class, 'preview'])->name('product.preview');

// Add this route for search
Route::get('/search', [SearchController::class, 'search'])->name('search');

  

