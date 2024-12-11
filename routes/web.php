<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\OrderHistoryController;

// Admin routes
Route::get('/admin/employee/positions', [EmployeeController::class, 'getPositionData']);
Route::get('admin/products-per-category', [App\Http\Controllers\Admin\ProductController::class, 'getProductsPerCategory']);
Route::get('/inventory/stock-data', [InventoryController::class, 'getStockData']);


Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
   
    
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::view('/admin/categories', 'admin.categories.index')->name('admin.categories.index');
    Route::view('/admin/product', 'admin.products.index')->name('admin.products.index');
    Route::view('users', 'admin.users.index')->name('admin.users.index');
    Route::view('/admin/position', 'admin.position.index')->name('admin.position.index');
    // Route::view('/admin/worker', 'admin.worker.index')->name('admin.worker.index');
    Route::view('/admin/employee', 'admin.employee.index')->name('admin.employee.index');
    Route::view('/inventory', 'admin.inventory')->name('admin.inventory');
// web.php
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
// web.php
Route::patch('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');


    
});
    //PRODUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUCCCCCCCCCCCCCCCCCCCCCCCCCT UNANG GUMAGANA KASI WALANG IMAGE
    // Route::post('/deleteadminproduct',[AdminProductController::class, 'destroy']);
    // Route::post('/addadminproduct',[AdminProductController::class, 'store']);
    // Route::post('/getProductID',[AdminProductController::class, 'edit']);
    // Route::post('/updateadminproduct',[AdminProductController::class, 'update']);
    // Route::get('getProducts', [AdminProductController::class, 'index']);
    // Route::post('saveProduct', [AdminProductController::class, 'store']);
    // Route::get('getProduct/{id}', [AdminProductController::class, 'show']);
    // Route::delete('deleteProduct/{id}', [AdminProductController::class, 'destroy']);


    // Route::get('/products/{id}', [AdminProductController::class, 'show'])->name('products.show');

    Route::post('/cart/increase', [CartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::post('/cart/decrease', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::get('/cart/count', [CartController::class, 'cartCount']);
    //INVENTORYYYYYYYYYYYYY


// Route for displaying the products index page
    Route::get('/products', [AdminProductController::class, 'index']);

    // Route for storing a new product
    Route::post('/addproduct', [AdminProductController::class, 'store']);

    // Route for getting all products (for DataTables or similar)
    Route::get('/getproducts', [AdminProductController::class, 'getProductData']);

    // Route for getting a single product by ID
    Route::post('/getproductid', [AdminProductController::class, 'edit']);

    // Route for updating a product
    Route::post('/updateproduct', [AdminProductController::class, 'update']);

    // Route for deleting a product
    Route::post('/deleteproduct', [AdminProductController::class, 'destroy']);
    
    // Route::get('products', [AdminProductController::class, 'index']);
    // Route::get('getProducts', [AdminProductController::class, 'getProducts']);
    // Route::post('saveProduct', [AdminProductController::class, 'saveProduct']);
    // Route::delete('deleteProduct/{id}', [AdminProductController::class, 'deleteProduct']);


    Route::get('/search', [SearchController::class, 'search'])->name('search');



    //EMPLOYEEEEEEEEEEEEEEEEEEEEEEEEEEEE
    // Route::post('/deleteadminemployee',[EmployeeCrudController::class, 'destroy']);
    // Route::post('/addadminemployee',[EmployeeCrudController::class, 'store']);
    // Route::post('/getEmployeeID',[EmployeeCrudController::class, 'edit']);
    // Route::post('/updateadminemployee',[EmployeeCrudController::class, 'update']);




    // Cart routes
    Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    

    // Products route for users
    
    // Route to add a product to the cart
    // Route::post('/customer/add-to-cart', [UserProductController::class, 'addToCart'])->name('customer.add_to_cart');
    
    Route::get('/customer/products', [UserProductController::class, 'index'])->name('customer.products');
    Route::view('/products', 'products.index')->name('products.index');
    // Route::get('/products', [UserProductController::class, 'products.index'])->name('products.index');
    // Welcome route
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Dashboard route
    Route::get('dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Profile routes
    Route::middleware('auth')->group(function () {
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    Route::post('/cart/select', [CartController::class, 'selectItems'])->name('cart.select');
    Route::post('/cart/deselect', [CartController::class, 'deselectItems'])->name('cart.deselect');
    Route::get('/order-confirmation', [UserOrderController::class, 'confirmation'])->name('order.confirmation');
    Route::middleware(['auth'])->group(function () {
        Route::get('/checkout', [UserOrderController::class, 'checkoutView'])->name('checkout.view');
        Route::post('/checkout/place', [CheckoutController::class, 'place'])->name('checkout.place');
        Route::post('/cart/update-selection', [CartController::class, 'updateSelection'])->name('cart.updateSelection');
        Route::get('/order-confirmation/{order}', [UserOrderController::class, 'orderConfirmation'])->name('order.confirmation');
    });
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('orderhistory.index');
    });

    Route::get('/orderhistory', [OrderHistoryController::class, 'index'])->name('orderhistory.index');
    Route::post('/order/{orderId}/cancel', [OrderHistoryController::class, 'cancel'])->name('order.cancel');
    
    Route::get('order-success/{order}', function (Order $order) {
        return view('order-success', compact('order'));
    })->name('order.success')->middleware('auth');


    // Include auth routes
    require __DIR__.'/auth.php';
