<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController; //-
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\ProductController as UserProductController;



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/remove', [CartController::class, 'removeFromCart']);
    Route::post('/cart/increase', [CartController::class, 'increaseQuantity']);
    Route::post('/cart/decrease', [CartController::class, 'decreaseQuantity']);
    Route::get('/cart', [CartController::class, 'viewCart']);
});
    
    // routes/api.php
    
    Route::post('/api/checkout', [CheckoutController::class, 'place']);
    Route::get('/api/cart', [CartController::class, 'getCartItems']);
    Route::post('/cart/select', [CartController::class, 'selectItems']);
    Route::post('/cart/deselect', [CartController::class, 'deselectItems']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/checkout/place', [CheckoutController::class, 'place']);
    });

    Route::apiResource('userproducts', UserProductController::class);//shop
    Route::apiResource('inventories', InventoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('positions', PositionController::class);
    Route::apiResource('users', UserController::class);
    Route::post('/users/{id}/update-admin', [UserController::class, 'updateAdmin']);
    Route::post('/users/{id}/deactivate', [UserController::class, 'deactivateUser']);
    Route::post('/users/{id}/activate', [UserController::class, 'activateUser']);
    Route::apiResource('categories', CategoryController::class);
    // Route::apiResource('orders', OrderHistoryController::class);


    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::get('/order-history', [OrderHistoryController::class, 'index']);
    //     Route::post('/orders/{order}/cancel', [OrderHistoryController::class, 'requestCancellation']);
    // });
    // Route::apiResource('orders', OrderHistoryController::class);


    // Route::apiResource('products', ProductController::class)->names([
    //     'index' => 'api.products.index',
    //     'store' => 'api.products.store',
    //     'show' => 'api.products.show',
    //     'update' => 'api.products.update',
    //     'destroy' => 'api.products.destroy',
    // ]);
    // Example user route
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    