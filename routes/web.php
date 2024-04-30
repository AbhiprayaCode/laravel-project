<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/register');
});

Route::prefix('admin')->controller(AdminController::class)->group(function(){
    Route::get('/', 'index')->middleware(['auth', 'verified'])->name('admin');

    Route::get('/add/products', 'getCategories')->middleware(['auth','verified'])->name('admin.add');
    Route::post('/add/products', 'addProduct')->middleware(['auth', 'verified'])->name('admin.addProducts');

    Route::get('/update/products/{id}', 'getProductForUpdate')->middleware(['auth','verified'])->name('admin.getProductForUpdate');
    Route::put('/update/products/{id}', 'updateProduct')->middleware(['auth','verified'])->name('admin.updateProduct');

    Route::get('/add/categories', function(){
        return view('/admin/categories');
    })->middleware(['auth','verified'])->name('admin.addCategories');
    Route::post('/add/categories', 'addCategory')->middleware(['auth', 'verified'])->name('admin.addCategory');

    Route::delete('/delete/products/{id}',  'deleteProduct')->middleware(['auth', 'verified'])->name('admin.deleteProduct');

    Route::get('/orders/list',  'displayData')->middleware(['auth', 'verified'])->name('admin.orders.updateStatus');
    Route::put('/orders/list/{id}',  'updateOrderStatus')->middleware(['auth', 'verified'])->name('admin.updateOrderStatus');
});



Route::get('/dashboard', [MenuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'verified'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('cart.add');
Route::post('/cart/increment/{id}', [CartController::class, 'incrementQuantity'])->middleware(['auth', 'verified'])->name('cart.increment');
Route::post('/cart/decrement/{id}', [CartController::class, 'decrementQuantity'])->middleware(['auth', 'verified'])->name('cart.decrement');
Route::post('/checkout', [CartController::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout');
Route::get('/orders/status', [CartController::class, 'showProductsByOrderItems'])->middleware(['auth', 'verified'])->name('orders.index');
Route::delete('/orders/status/cancel/{id}', [CartController::class, 'cancelOrder'])->middleware(['auth', 'verified'])->name('orders.cancel');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
