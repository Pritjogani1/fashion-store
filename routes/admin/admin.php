<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StaticBlockController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AuthAdminController; 
use App\Http\Controllers\Admin\PermissionController;



use Illuminate\Support\Str;



Route::prefix("admin")->group(function() {
    // Guest routes
    Route::middleware("guest:admin")->group(function() {
        Route::get("login", [AdminController::class, "index"])->name("admin.login");
        Route::post("login", [AdminController::class, "authenticate"])->name("admin.authenticate");
    });

    // Authenticated routes
    Route::middleware("auth:admin")->group(function() {
        Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard")->can('dashboard');
        Route::get("logout", [AdminController::class, "logout"])->name("admin.logout");
        

 
        Route::prefix('admins')->group(function(){
            Route::get('/',[AuthAdminController::class,'index'])->name('admin.admins.index');

            Route::get('/create',[AuthAdminController::class,'create'])->name('admin.admins.create');
            Route::post('/create',[AuthAdminController::class,'store'])->name('admin.admins.store');

            Route::get('/{admin}/edit',[AuthAdminController::class,'edit'])->name('admin.admins.edit');
            Route::patch('/{admin}/update',[AuthAdminController::class,'update'])->name('admin.admins.update');
            Route::delete('/{admin}/delete',[AuthAdminController::class,'destroy'])->name('admin.admins.destroy');
        });

        Route::prefix('role')->group(function(){
            Route::get('/',[RoleController::class,'index'])->name('admin.role');

            Route::get('/create',[RoleController::class,'create'])->name('admin.role.create');
            Route::post('/create',[RoleController::class,'store'])->name('admin.role.store');

            Route::get('/{role}/edit',[RoleController::class,'edit'])->name('admin.role.edit');
            Route::patch('/{role}/update',[RoleController::class,'update'])->name('admin.role.update');

            Route::delete('/{role}/delete',[RoleController::class,'destroy'])->name('admin.role.destroy');
        });
        
        Route::prefix('permission')->group(function(){
            Route::get('/',[PermissionController::class,'index'])->name('admin.permission');

            Route::get('/create',[PermissionController::class,'create'])->name('admin.permission.create');
            Route::post('/create',[PermissionController::class,'store'])->name('admin.permission.store');

            Route::get('/{permission}/edit',[PermissionController::class,'edit'])->name('admin.permission.edit');
            Route::patch('/{permission}/update',[PermissionController::class,'update'])->name('admin.permission.update');

            Route::delete('/{permission}/delete',[PermissionController::class,'destroy'])->name('admin.permission.destroy');
        });
        
    
        
        // Users management
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edituser');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');
        Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');

        // Orders management
        Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::get('/orders/{order}', [AdminController::class, 'orderDetails'])->name('admin.orders.details');
        Route::post('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');

        // Categories management
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index')->can('categories');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Products management
        Route::get('/products', [ProductController::class, 'allproducts'])->name('admin.products');
        Route::get('/addproducts', [ProductController::class, 'addproduct'])->name('admin.addproducts');
        Route::post('/addproduct', [ProductController::class, 'store'])->name('admin.addproduct');
        Route::get('/editproduct/{id}', [ProductController::class, 'editproduct'])->name('admin.editproduct');
        Route::post('/editproduct/{id}', [ProductController::class, 'updateproduct'])->name('admin.updateproduct');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy'])->name('admin.deleteproduct');


        // Static Blocks management
        Route::get('/static-blocks', [StaticBlockController::class, 'index'])->name('admin.static-blocks.index');
        Route::get('/static-blocks/create', [StaticBlockController::class, 'create'])->name('admin.static-blocks.create');
        Route::post('/static-blocks', [StaticBlockController::class, 'store'])->name('admin.static-blocks.store');
        Route::get('/static-blocks/{block}/edit', [StaticBlockController::class, 'edit'])->name('admin.static-blocks.edit');
        Route::put('/static-blocks/{block}', [StaticBlockController::class, 'update'])->name('admin.static-blocks.update');
        Route::delete('/static-blocks/{block}', [StaticBlockController::class, 'destroy'])->name('admin.static-blocks.destroy');

        // Utilities
        Route::get('/generate-slug', function() {
            return response()->json(['slug' => Str::slug(request()->name)]);
        })->name('admin.generate-slug');
    });
});