<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Str;
use App\Http\Controllers\OrderController;
use App\Models\Category;
use App\Models\Product;


Route::middleware("guest:user")->group(function() {
    Route::get("register", [RegisterUserController::class, "create"])->name("");
    Route::post("register", [RegisterUserController::class, "store"])->name("register");
    Route::get("login", [SessionController::class, "index"])->name("user.login");
    Route::post("login", [SessionController::class, "authenticate"])->name("user.authenticate");

});
    Route::get("/", [Homepage::class, "index"])->name("homepage");
Route::get('/men/{category?}',[Homepage::class,'men'])->name('men');


Route::middleware("auth:user")->group(function() {
    Route::get("logout", [SessionController::class, "logout"])->name("user.logout");
   
    Route::get('/about',[Homepage::class,'about'])->name('about');

    Route::get('/women/{category?}',[Homepage::class,'women'])->name('women');
    Route::get('/children/{category?}',[Homepage::class,'children'])->name('children');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');
    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    

});



Route::prefix("admin")->group(function() {

    Route::middleware("guest:admin")->group(function() {
        Route::get("login", [AdminController::class, "index"])->name("admin.login");
        Route::post("login", [AdminController::class, "authenticate"])->name("admin.authenticate");
    });

    Route::middleware("auth:admin")->group(function() {
        Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");
        Route::get("logout", [AdminController::class, "logout"])->name("admin.logout");

        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edituser');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');
    });

});

    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/orders/{order}', [AdminController::class, 'orderDetails'])->name('admin.orders.details');
    Route::post('/admin/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');



Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers');

Route::get('/admin/categories',[CategoryController::class,'index'])->name('admin.categories.index');
Route::post('/admin/categories',[CategoryController::class,'store'])->name('admin.categories.store');
Route::delete('/admin/categories/{category}',[CategoryController::class,'destroy'])->name('admin.categories.destroy');


Route::get('/admin/products',[ProductController::class,'allproducts'])->name('admin.products');

Route::get('/admin/addproducts',[ProductController::class,'addproduct'])->name('admin.addproduct');

Route::post('/admin/addproduct',[ProductController::class,'store'])->name('admin.addproduct');

Route::get('/admin/editproduct/{id}',[ProductController::class,'editproduct'])->name('admin.editproduct');

Route::post('/admin/editproduct/{id}',[ProductController::class,'updateproduct'])->name('admin.updateproduct');

Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

Route::delete('/admin/deleteproduct/{id}',[ProductController::class,'destroy'])->name('admin.deleteproduct');







Route::get('/products/{category:slug}', [ProductController::class, 'byCategory'])
    ->name('products.category');

    
Route::get('/admin/generate-slug', 
function() {
    $slug = Str::slug(request()->name);
    return response()->json(['slug' => $slug]);
})->name('admin.generate-slug');
    


Route::middleware(['auth:user'])->group(function () {
    // ... existing routes ...
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/address', [OrderController::class, 'storeAddress'])->name('checkout.address');
    Route::get('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/success/{order}', [OrderController::class, 'orderSuccess'])->name('order.success');
});