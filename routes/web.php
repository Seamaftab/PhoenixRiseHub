<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\SrcController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'welcome'])->name('welcome');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function()
{
    Route::get('/dashboard', [BackendController::class, 'dashboard'])->name('dashboard');

    //users
    Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');
    Route::resource('/users', UserController::class);
    Route::patch('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

    //products
    Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::resource('/products', ProductController::class);
    Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');

    Route::resource('/categories', CategoryController::class);

    Route::resource('/carts', CartController::class);

    //Orders
    Route::get('/orders/cancelled', [OrderController::class, 'cancelled_orders'])->name('cancelled');
    Route::resource('/orders', OrderController::class);
    Route::patch('/orders/{order}/restore', [OrderController::class, 'restore'])->name('orders.restored');
    Route::delete('/orders/{order}', [OrderController::class, 'cancel_order'])->name('orders.cancel');
    Route::delete('/orders/{order}/delete', [OrderController::class, 'delete'])->name('orders.remove');
    Route::get('/order_confirmed', [OrderController::class, 'confirmed'])->name('order_confirmed');

    //Purchase Requests
    Route::resource('/purchaseRequests', PurchaseRequestController::class);

    //Stock Record Cart
    Route::resource('/src', SrcController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/{slug}', [FrontendController::class, 'categoryWiseProducts'])->name('category.products');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('product_details');

